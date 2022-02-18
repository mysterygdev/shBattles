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
        'price' => $res[0]->ProductCost,
        'tag' => $res[0]->Tag,
        'qty' => $qty
      ];

      // Insert item to cart
      $insertItem = $data['webmall']->insert($itemData);
      // Redirect to cart page
      $_SESSION['message'] = '('.$itemData['name'].') was added to your cart.';
      $redirectLoc = $insertItem?'/game/webmall':'/';
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
          $stmt = DB::table(table('shUserData'))
            ->select()
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->limit(1)
            ->get();
          $data['webmall']->getPoints	=	$stmt[0]->Point;
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
          $stmt = DB::table(table('shUserData'))
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->update(['Point' => $newPoints]);
          //while ($quantity <=	$item['qty']) {
            $stmt = DB::table(table('shPointLog'))
              ->insert([
                  'UserUID' => $_SESSION['User']['UserUID'],
                  'CharID' => 1,
                  'UsePoint' => $data['webmall']->total(),
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
              if (in_array($itemType, $data['webmall']->getNonStackableTypes())) {
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
    }
    $_SESSION['sessData'] = $sessData;
  }
  if ($redirectLoc) {
    // Redirect to the specific page
    header("Location: $redirectLoc");
    exit();
  }
 ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/game/webmall/cartAction.blade.php ENDPATH**/ ?>