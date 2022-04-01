<?php
    namespace DB\Queries;

    Use Illuminate\Database\Capsule\Manager as Eloquent;
    Use Utils\Arrays;

    class WebmallDB{

        public static $maxSlot=239,$nextSlot,$slotCount;

        public static function __get_UserPoint($UserUID){
            $stmt   =   Eloquent::table(table('shUserData'))
                        ->where('UserUID', $UserUID)
                        ->get();

            $stmt    =   Arrays::__cleanup_obj($stmt,true);


            return $stmt;
        }
        public static function __gen_OrderID($UserUID){
            $stmt   =   Eloquent::table(table('orderHistory'))
                        ->where('UserUID',$UserUID)
                        ->orderBy('OrderNumber', 'DESC')
                        ->get();

            if(!$stmt->isEmpty()){
                return $stmt+1;
            }
            else{
                return '000001';
            }
        }
        public static function __get_prods_by_prodID($productID){
            $stmt   =   Eloquent::table(table('products'))
                        ->where('ProductID', $productID)
                        ->where('Main', 1)
                        ->orderBy('ProductID', 'DESC')
                        ->get();

            return $stmt;
        }
        public static function __get_prod_code($product_code){
            $stmt = Eloquent::table(table('products'))
                    ->select()
                    ->where('ProductCode', $product_code)
                    ->get();

            return $stmt;
        }
        public static function __insert_user_point($UserUID, $total, $currency, $product_code){
            $stmt = Eloquent::table(table('shPointLog'))
                    ->insert([
                        'UserUID' => $UserUID,
                        'CharID' => 1,
                        'UsePoint' => $total,
                        'Currency' => $currency,
                        'ProductCode' => $product_code,
                        'UseType' => 1
                    ]);

            return $stmt;
        }
        public static function __sel_prod_code_from_prods($product_code){
            $stmt = Eloquent::table(table('products'))
                    ->select('Type', 'ItemID', 'ItemCount')
                    ->where('ProductCode', $product_code)
                    ->get();

            return $stmt;
        }
        public static function __set_slot_data($UserUID){
            $stmt = Eloquent::table(table('shUserBank'))
                    ->select('slot')
                    ->where('UserUID', $UserUID)
                    ->get();

            self::$slotCount    =   self::__get_slot_count($stmt);
            self::$nextSlot     =   self::$slotCount+1;
        }
        public static function __get_slot_count($cnt){
            $count=count($cnt);
            return $count;
        }
        public static function __hasSlots(){
            if(self::$slotCount<self::$maxSlot){
                return true;
            }

            return false;
        }
        public static function __insert_into_bank($UserUID, $Slot, $ItemID, $ItemCount, $Prod_Code){
            $stmt = Eloquent::table(table('shUserBank'))
                    ->insert([
                        'UserUID' => $UserUID,
                        'Slot' => $Slot,
                        'ItemID' => $ItemID,
                        'ItemCount' => $ItemCount,
                        'ProductCode' => $Prod_Code
            ]);
        }
        public static function __insert_order_history($UserUID,$OrderID,$ProdCode,$ItemName,$ItemDesc,$ItemCost,$ItemQuantity){
            $stmt   =   Eloquent::table(table('orderHistory'))
                        ->insert([
                            'UserUID'       =>  $UserUID,
                            'OrderNumber'   =>  $OrderID,
                            'ProductCode'   =>  $ProdCode,
                            'ItemName'      =>  $ItemName,
                            'ItemDesc'      =>  $ItemDesc,
                            'ItemCost'      =>  $ItemCost,
                            'ItemQuantity'  =>  $ItemQuantity,
                        ]);
        }
    }
?>
