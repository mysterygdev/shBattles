<?php

  Use DB\Queries\WebMallDB;
  Use Utils\{
    Arrays,
    Data
  };
  Use Illuminate\Database\Capsule\Manager as DB;

  $redirectLoc	=	'/game/webmall';

  if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    if ($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])) {
      $productID  = $_REQUEST['id'];
      $qty		    =	$_POST['Quantity'];

      $res = WebMallDB::__get_prods_by_prodID($productID);
      $res = Arrays::__cleanup_obj($res,true);

      $itemData = [
        'id'    => $res->ProductID,
        'code'  => $res->ProductCode,
        'image' => $res->ProductImage,
        'name'  => $res->ProductName,
        'desc'  => $res->ProductDesc,
        'crncy' => $res->ProductCurrency,
        'price' => $res->ProductCost,
        'tag'   => $res->Tag,
        'qty'   => $qty
      ];

      // Insert item to cart
      $insertItem = $data['webmall']->insert($itemData);

      // Redirect to cart page
      $_SESSION['message']  = '('.$itemData['name'].') was added to your cart.';
      $redirectLoc          = $insertItem?$_SERVER['HTTP_REFERER']:'/game/webmall';
    }
    elseif ($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])) {
      // Update item data in cart
      $itemData = [
        'rowid' => $_REQUEST['id'],
        'qty' => $_REQUEST['qty']
      ];
      $updateItem = $data['webmall']->update($itemData);
      // Return status
      die($updateItem?'ok':'err');
    }
    elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])) {
      // Remove item from cart
      $deleteItem = $data['webmall']->remove($_REQUEST['id']);

      // Redirect to cart page
      $redirectLoc = '/game/webmall/cart';
      $productName = $data['webmall']->getProductName($_REQUEST['prodId']);
      $_SESSION['message'] = '('.$productName.') was removed from your cart.';
    }
    elseif (
      $_REQUEST['action'] == 'placeOrder' &&
      $data['webmall']->totalItems() > 0
    ){
      $redirectLoc  = '/game/webmall/checkout';
      $cartItems    = $data['webmall']->contents();
      $orderID      = WebmallDB::__gen_OrderID($_SESSION['User']['UserUID']);

      foreach ($cartItems as $item){
        $itemQuantity = $item['qty'];

      }
      $itemCount    = count($cartItems);

      foreach ($cartItems as $item) {
        $itemName     = $item['name'];
				$itemDesc     = $item['desc'];
				$itemCost     = $item['price']*$item['qty'];
				$itemQuantity = $item['qty'];
        $product_code	=	$item['code'];
        $quantity	    =	1;

        // Get item currency type
        if (isset($_SESSION['User'])) {
          if (in_array(
            $data['webmall']->getCurrency($item['id']),
            $data['webmall']->getValidCurrencies())
          ){
            if ($data['webmall']->getCurrency($item['id']) == 'dp') {
              $data['webmall']->getPoints	=	$data['webmall']->getDpPoints();
            }
            if ($data['webmall']->getCurrency($item['id']) == 'vip') {
              $data['webmall']->getPoints	=	$data['webmall']->getVipPoints();
            }
            if ($data['webmall']->getCurrency($item['id']) == 'ap') {
              $data['webmall']->getPoints	=	$data['webmall']->getApPoints();
            }
            if ($data['webmall']->getCurrency($item['id']) == 'gp') {
              $data['webmall']->getPoints	=	$data['webmall']->getGpPoints();
            }
          }
        }

        // Get prod code
        WebmallDB::__get_prod_code($product_code);

        // Get currency subtotal from item quantity
        $subtotal =	($item['price'] * $item['qty']);

        if ($data['webmall']->getPoints	>=$subtotal) {
          $newPoints = $data['webmall']->getPoints - $subtotal;

          if (in_array(
            $data['webmall']->getCurrency($item['id']),
            $data['webmall']->getValidCurrencies())
          ){
            if ($data['webmall']->getCurrency($item['id']) == 'dp') {
              $data['webmall']->updateDpPoints($newPoints);
            }
            if ($data['webmall']->getCurrency($item['id']) == 'vip') {
              $data['webmall']->updateVipPoints($newPoints);
            }
            if ($data['webmall']->getCurrency($item['id']) == 'ap') {
              $data['webmall']->updateApPoints($newPoints);
            }
            if ($data['webmall']->getCurrency($item['id']) == 'gp') {
              $data['webmall']->updateGpPoints($newPoints);
            }
          }

          $stmt=WebMallDB::__sel_prod_code_from_prods($product_code);

          foreach ($stmt as $product) {
            $slot         = 0;
            $itemType		  =	$product->Type;
            $itemID		    =	$product->ItemID;
            $itemCount	  =	$product->ItemCount;
            $itemQuantity = $itemQuantity;
            $totalCount   = $itemQuantity * $itemCount;

            // set slot data
            WebmallDB::__set_slot_data($_SESSION['User']['UserUID']);

            if(in_array($itemType, $data['webmall']->getNonStackableTypes())){
              if($quantity <= $itemQuantity){
                if(WebMallDB::__hasSlots()){
                  $slot=WebMallDB::__get_slot_count($sql);

                  if(WebmallDB::$nextSlot < 239){
                    for($i=0;$i=$quantity;$i++){
                      // force item to not be stacked.. no more quantity than 1
                      $itemCount = 1;

                      WebMallDB::__insert_into_bank($_SESSION['User']['UserUID'],$slot+1,$itemID,$itemCount,$product_code);

                      $quantity	=	$quantity+1;
                    }
                  }
                  else{
                    echo 'User has insufficient space to recieve any new items at this time';
                  }
                }
                else{
                  echo 'User: '.$_SESSION['User']['UserID'].' has too many Items in his/her gift box and can not hold any more.';

                  $sessData['status']['type'] = 'error';
                }
              }
            }
            else{
              while ($quantity <= $itemQuantity){
                if(WebMallDB::__hasSlots()){
                  $slot=WebMallDB::__get_slot_count($sql);

                  if(WebmallDB::$nextSlot < 239){
                    // force item to not be stacked.. no more quantity than 1
                    WebMallDB::__insert_into_bank($_SESSION['User']['UserUID'],$slot+1,$itemID,$itemCount,$product_code);

                    $quantity	=	$quantity+1;
                  }
                  else{
                    echo 'User: '.$_SESSION['User']['UserID'].' has too many Items in his/her gift box and can not hold any more.';

                    $sessData['status']['type'] = 'error';
                  }
                }
              }
            }

            WebmallDB::__insert_order_history($_SESSION['User']['UserUID'],$orderID,$product_code,$itemName,$itemDesc,$itemCost,$itemQuantity);

            $data['webmall']->destroy();

            // Redirect to the status page
            $redirectLoc = '/game/webmall/orderSuccess?id='.$orderID;
          }
#          else{
#            $redirectLoc = '/game/webmall/orderFail';
#          }
        }
      }
#      elseif($_REQUEST['action'] == 'clearCart' && $data['webmall']->totalItems() > 0){
#        $data['webmall']->destroy();
#        $_SESSION['message'] = 'Cart has been emptied successfully.';
#      }

      $_SESSION['sessData'] = $sessData;
    }

    if($redirectLoc){
      // Redirect to the specific page
      header("Location: $redirectLoc");
      exit();
    }
  }
?>
<?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/game/webmall/cartAction.blade.php ENDPATH**/ ?>