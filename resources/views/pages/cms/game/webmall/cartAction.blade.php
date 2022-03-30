<?php
  use Illuminate\Database\Capsule\Manager as DB;
  $redirectLoc	=	'/game/webmall';

  if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
    if ($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])) {
      $productID = $_REQUEST['id'];
      $qty		=	$_POST['Quantity'];

      $res = DB::table(table('products'))
            ->select()
            ->where('ProductID', $productID)
            ->where('Main', 1)
            ->orderBy('ProductID', 'DESC')
            ->get();

      $itemData = [
        'id' => $res[0]->ProductID,
        'code' => $res[0]->ProductCode,
        'image' => $res[0]->ProductImage,
        'name' => $res[0]->ProductName,
        'desc' => $res[0]->ProductDesc,
        'crncy' => $res[0]->ProductCurrency,
        'price' => $res[0]->ProductCost,
        'tag' => $res[0]->Tag,
        'qty' => $qty
      ];

      // Insert item to cart
      $insertItem = $data['webmall']->insert($itemData);
      // Redirect to cart page
      $_SESSION['message'] = '('.$itemData['name'].') was added to your cart.';
      $redirectLoc = $insertItem?$_SERVER['HTTP_REFERER']:'/game/webmall';
    } elseif ($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])) {
      // Update item data in cart
      $itemData = [
        'rowid' => $_REQUEST['id'],
        'qty' => $_REQUEST['qty']
      ];
      $updateItem = $data['webmall']->update($itemData);
      // Return status
      echo $updateItem?'ok':'err';die;
    } elseif ($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])) {
      // Remove item from cart
      $deleteItem = $data['webmall']->remove($_REQUEST['id']);
      // Redirect to cart page
      $redirectLoc = '/game/webmall/cart';
      $productName = $data['webmall']->getProductName($_REQUEST['prodId']);
      $_SESSION['message'] = '('.$productName.') was removed from your cart.';
    } elseif ($_REQUEST['action'] == 'placeOrder' && $data['webmall']->totalItems() > 0) {
      $redirectLoc = '/game/webmall/checkout';
      $cartItems = $data['webmall']->contents();
      $orderID  = mt_rand(100000, 999999);
      foreach ($cartItems as $item) {
        $itemName =   $item['name'];
				$itemDesc =   $item['desc'];
				$itemCost =   $item['price']*$item['qty'];
				$itemQuantity =   $item['qty'];

        if (isset($_SESSION['User'])) {
          if (in_array($data['webmall']->getCurrency($item['id']), $data['webmall']->getValidCurrencies())) {
            if ($data['webmall']->getCurrency($item['id']) == 'dp') {
              $data['webmall']->getPoints	=	$data['webmall']->getDpPoints();
            }
            if ($data['webmall']->getCurrency($item['id']) == 'vip') {
              $data['webmall']->getPoints	=	$data['webmall']->getVipPoints();
            }
            /* if ($data['webmall']->getCurrency($item['id']) == 'ap') {
              $data['webmall']->getPoints	=	$data['webmall']->getApPoints();
            }
            if ($data['webmall']->getCurrency($item['id']) == 'gp') {
              $data['webmall']->getPoints	=	$data['webmall']->getGpPoints();
            } */
          }
        }
        $product_code	=	$item['code'];
        // query might not be needed
        $stmt = DB::table(table('products'))
            ->select()
            ->where('ProductCode', $product_code)
            ->get();
        $subtotal		=	($item['price']*$item['qty']);
        if ($data['webmall']->getPoints	>=$subtotal) {
          $quantity	=	1;
          $newPoints	=	$data['webmall']->getPoints - $subtotal;
          if (in_array($data['webmall']->getCurrency($item['id']), $data['webmall']->getValidCurrencies())) {
            if ($data['webmall']->getCurrency($item['id']) == 'dp') {
              $data['webmall']->updateDpPoints($newPoints);
            }
            if ($data['webmall']->getCurrency($item['id']) == 'vip') {
              $data['webmall']->updateVipPoints($newPoints);
            }
            /* if ($data['webmall']->getCurrency($item['id']) == 'ap') {
              $data['webmall']->updateApPoints($newPoints);
            }
            if ($data['webmall']->getCurrency($item['id']) == 'gp') {
              $data['webmall']->updateGpPoints($newPoints);
            } */
          }
          /* $stmt = DB::table(table('shUserData'))
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->update(['Point' => $newPoints]); */
          //while ($quantity <=	$item['qty']) {
            $stmt = DB::table(table('shPointLog'))
              ->insert([
                  'UserUID' => $_SESSION['User']['UserUID'],
                  'CharID' => 1,
                  'UsePoint' => $data['webmall']->total(),
                  'Currency' => $data['webmall']->getCurrency($item['id']),
                  'ProductCode' => $product_code,
                  'UseType' => 1
              ]);
            $stmt = DB::table(table('products'))
              ->select('Type', 'ItemID', 'ItemCount')
              ->where('ProductCode', $product_code)
              ->get();
            foreach ($stmt as $product) {
            #while ($product=$stmtItem->fetch()) {
              $slot = 0;
              $itemType		=	$product->Type;
              $itemID		=	$product->ItemID;
              $itemCount	=	$product->ItemCount;
              $totalCount = $itemQuantity * $itemCount;


              #while ($data=$stmtSlot->fetch()) {
              $sql = ('
                        Declare @Empty smallint
                        Declare @Slot smallint
                        Set @Slot = 0
                        Set @Empty = 0
                        WHILE (@Slot <= 239)
                          BEGIN
                          SET @empty = (SELECT COUNT(Slot) FROM PS_GameData.dbo.UserStoredPointItems WHERE UserUID = ? AND Slot = @Slot)
                          IF (@empty <= 0) BREAK
                          ELSE
                          SET @Slot = @Slot+1
                          END
                          Select @Slot as Slot
              ');

              $stmtSlot = DB::select(DB::raw($sql), [$_SESSION['User']['UserUID']]);
              foreach ($stmtSlot as $fet) {
                if ($fet->Slot<240) {
                  $slot		=	$fet->Slot;
                } else {
                  $slot = null;
                  $sessData['status']['type'] = 'error';
                }
              }
              if (in_array($itemType, $data['webmall']->getNonStackableTypes())) {
                /* if (!empty($slot) || $slot !== null) {
                  echo 'slot: '.$slot;
                  die();
                } else {
                  echo 'slot null1';
                  die();
                } */
                while ($quantity <= $itemQuantity) {
                  $sql = ('
                        Declare @Empty smallint
                        Declare @Slot smallint
                        Set @Slot = 0
                        Set @Empty = 0
                        WHILE (@Slot <= 239)
                          BEGIN
                          SET @empty = (SELECT COUNT(Slot) FROM PS_GameData.dbo.UserStoredPointItems WHERE UserUID = ? AND Slot = @Slot)
                          IF (@empty <= 0) BREAK
                          ELSE
                          SET @Slot = @Slot+1
                          END
                          Select @Slot as Slot
                  ');

                  $stmtSlot = DB::select(DB::raw($sql), [$_SESSION['User']['UserUID']]);
                  foreach ($stmtSlot as $fet) {
                    if ($fet->Slot<240) {
                      $slot		=	$fet->Slot;
                    } else {
                      echo 'User: '.$_SESSION['User']['UserID'].' has too many Items in his/her gift box and can not hold any more.';
                      $sessData['status']['type'] = 'error';
                    }
                  }
                  // force item to not be stacked.. no more quantity than 1
                  $itemCount = 1;
                  $stmt = DB::table(table('shUserBank'))
                  ->insert([
                      'UserUID' => $_SESSION['User']['UserUID'],
                      'Slot' => $slot,
                      'ItemID' => $itemID,
                      'ItemCount' => $itemCount,
                      'ProductCode' => $product_code
                  ]);
                  $quantity	=	$quantity+1;
                }
              } else {
                /* if (!empty($slot) || $slot !== null) {
                  /* echo 'slot: '.$slot;
                  die(); */
                  /* $slotCount = floor($totalCount / 255);
                  $tooManyItems = ($slotCount > 1);
                  if ($tooManyItems) {
                    $leftOver = $itemCount-($slotCount * 255);
                    echo 'leftover: '.$leftOver;
                  } else {
                    echo 'not too much<br>';
                    echo 'total count: '.$totalCount.'<br>';
                  }
                  die();
                } else {
                  echo 'slot null';
                  die();
                } */
                $sql = ('
                        Declare @Empty smallint
                        Declare @Slot smallint
                        Set @Slot = 0
                        Set @Empty = 0
                        WHILE (@Slot <= 239)
                          BEGIN
                          SET @empty = (SELECT COUNT(Slot) FROM PS_GameData.dbo.UserStoredPointItems WHERE UserUID = ? AND Slot = @Slot)
                          IF (@empty <= 0) BREAK
                          ELSE
                          SET @Slot = @Slot+1
                          END
                          Select @Slot as Slot
                ');

                $stmtSlot = DB::select(DB::raw($sql), [$_SESSION['User']['UserUID']]);
                foreach ($stmtSlot as $fet) {
                  if ($fet->Slot<240) {
                    $slot		=	$fet->Slot;
                  } else {
                    echo 'User: '.$_SESSION['User']['UserID'].' has too many Items in his/her gift box and can not hold any more.';
                    $sessData['status']['type'] = 'error';
                  }
                }
                $stmt = DB::table(table('shUserBank'))
                ->insert([
                    'UserUID' => $_SESSION['User']['UserUID'],
                    'Slot' => $slot,
                    'ItemID' => $itemID,
                    'ItemCount' => $totalCount,
                    'ProductCode' => $product_code
                ]);
              }

              /* echo 'item count: '.$itemCount;
              echo 'item quantity: '.$itemQuantity;
              $totalCount = $itemQuantity * $itemCount;
              echo 'total quantity: '.$totalCount;
              die(); */

              /* $stmt = DB::table(table('shUserBank'))
              ->insert([
                  'UserUID' => $_SESSION['User']['UserUID'],
                  'Slot' => $slot,
                  'ItemID' => $itemID,
                  'ItemCount' => $itemCount,
                  'ProductCode' => $product_code
              ]); */
            }
            $stmt = DB::table(table('orderHistory'))
              ->insert([
                  'UserUID' => $_SESSION['User']['UserUID'],
                  'OrderNumber' => $orderID,
                  'ProductCode' => $product_code,
                  'ItemName' => $itemName,
                  'ItemDesc' => $itemDesc,
                  'ItemCost' => $itemCost,
                  'ItemQuantity' => $itemQuantity,
              ]);
            //$quantity	=	$quantity+1;
          //}
          $data['webmall']->destroy();
          // Redirect to the status page
					$redirectLoc = '/game/webmall/orderSuccess?id='.$orderID;
        } else {
          $redirectLoc = '/game/webmall/orderFail';
        }
      }
    } elseif ($_REQUEST['action'] == 'clearCart' && $data['webmall']->totalItems() > 0) {
      $data['webmall']->destroy();
      $_SESSION['message'] = 'Cart has been emptied successfully.';
    }
    $_SESSION['sessData'] = $sessData;
  }
  if ($redirectLoc) {
    // Redirect to the specific page
    header("Location: $redirectLoc");
    exit();
  }
