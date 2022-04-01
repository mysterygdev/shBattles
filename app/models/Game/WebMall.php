<?php

namespace Models\Game;

use Illuminate\Database\Capsule\Manager as DB;
Use DB\Queries\WebmallDB;
use Utils\{
    Arrays,
    Data,
    Session,
    User
};

class WebMall
{
    public static $name,$code,$quantity,$cost,$category,$special;
    public static $getPoints,$newPoints,$total,$totalCount;
    public static $subTotal,$slot,$maxSlot,$fet,$fetCount;
    protected static $cartContents = [];

    public function __construct()
    {
        new Data;
        new Session;
        new User;

        User::run();

        self::getItemCategory();
        self::getUserPoints();
        //$this->getUserGuildPoints();
        // get the shopping cart array from the session
        self::$cartContents = !empty($_SESSION['cart_contents']) ? $_SESSION['cart_contents'] : null;
        if (self::$cartContents === null) {
            // set some base values
            self::$cartContents = ['cart_total' => 0, 'total_items' => 0];
        }
    }

    /**
          * Cart Contents: Returns the entire cart array
          * @param    bool
          * @return    array
    */
    public static function contents()
    {
        // rearrange the newest first
        $cart = array_reverse(self::$cartContents);

        // remove these so they don't create a problem when showing the cart table
        unset($cart['total_items'], $cart['cart_total']);

        return $cart;
    }

    /**
          * Get cart item: Returns a specific cart item details
          * @param    string    $row_id
          * @return    array
    */
    public static function getItem($row_id)
    {
        return (in_array($row_id, ['total_items', 'cart_total'], true) or !isset(self::$cartContents[$row_id]))
            ? false
            : self::$cartContents[$row_id];
    }

    /**
          * Total Items: Returns the total item count
          * @return    int
    */
    public static function totalItems()
    {
        return self::$cartContents['total_items'];
    }

    /**
          * Cart Total: Returns the total price
          * @return    int
    */
    public static function total()
    {
        if (self::doesCouponCodeExist()) {
            //TODO: add min order value and max discount requirements
            $type = self::getCouponData(Session::get('WebMall', 'CouponCode'), 'Type');
            $value = self::getCouponData(Session::get('WebMall', 'CouponCode'), 'Value');
            if ($type == 'Percentage') {
                $total =  self::$cartContents['cart_total'] - (self::$cartContents['cart_total'] * ((int)($value)/100));
                self::$cartContents['cart_total'] = $total;
            } elseif ($type = 'Fixed') {
                $total =  self::$cartContents['cart_total'] - ((int)($value));
                self::$cartContents['cart_total'] = $total;
            }
            return self::$cartContents['cart_total'];
        } else {
            return self::$cartContents['cart_total'];
        }
    }

    /**
          * Insert items into the cart and save it to the session
          * @param    array
          * @return    bool
    */
    public static function insert($item = [])
    {
        if (!is_array($item) or count($item) === 0) {
            return false;
        } else {
            if (!isset($item['id'], $item['name'], $item['price'], $item['qty'])) {
                return false;
            } else {
                /*
                 * Insert Item
                 */
                // prep the quantity
                $item['qty'] = (float) $item['qty'];
                if ($item['qty'] == 0) {
                    return false;
                }
                // prep the price
                $item['price'] = (float) $item['price'];
                // create a unique identifier for the item being inserted into the cart
                $rowid = md5($item['id']);
                // get quantity if it's already there and add it on
                $old_qty = isset(self::$cartContents[$rowid]['qty']) ? (int) self::$cartContents[$rowid]['qty'] : 0;
                // re-create the entry with unique identifier and updated quantity
                $item['rowid'] = $rowid;
                $item['qty'] += $old_qty;
                self::$cartContents[$rowid] = $item;

                // save Cart Item
                if (self::saveCart()) {
                    return isset($rowid) ? $rowid : true;
                } else {
                    return false;
                }
            }
        }
    }

    /**
          * Update the cart
          * @param    array
          * @return    bool
    */
    public static function update($item = [])
    {
        if (!is_array($item) or count($item) === 0) {
            return false;
        } else {
            if (!isset($item['rowid'], self::$cartContents[$item['rowid']])) {
                return false;
            } else {
                // prep the quantity
                if (isset($item['qty'])) {
                    $item['qty'] = (float) $item['qty'];
                    // remove the item from the cart, if quantity is zero
                    if ($item['qty'] == 0) {
                        unset(self::$cartContents[$item['rowid']]);
                        return true;
                    }
                }

                // find updatable keys
                $keys = array_intersect(array_keys(self::$cartContents[$item['rowid']]), array_keys($item));
                // prep the price
                if (isset($item['price'])) {
                    $item['price'] = (float) $item['price'];
                }
                // product id & name shouldn't be changed
                foreach (array_diff($keys, ['id', 'name']) as $key) {
                    self::$cartContents[$item['rowid']][$key] = $item[$key];
                }
                // save cart data
                self::saveCart();
                return true;
            }
        }
    }

    /**
          * Save the cart array to the session
          * @return    bool
    */
    protected static function saveCart()
    {
        self::$cartContents['total_items'] = self::$cartContents['cart_total'] = 0;
        foreach (self::$cartContents as $key => $val) {
            // make sure the array contains the proper indexes
            if (!is_array($val) or !isset($val['price'], $val['qty'])) {
                continue;
            }

            self::$cartContents['cart_total'] += ($val['price'] * $val['qty']);
            self::$cartContents['total_items'] += $val['qty'];
            self::$cartContents[$key]['subtotal'] = (self::$cartContents[$key]['price'] * self::$cartContents[$key]['qty']);
        }

        // if cart empty, delete it from the session
        if (count(self::$cartContents) <= 2) {
            unset($_SESSION['cart_contents']);
            return false;
        } else {
            $_SESSION['cart_contents'] = self::$cartContents;
            return true;
        }
    }

    /**
          * Remove Item: Removes an item from the cart
          * @param    int
          * @return    bool
    */
    public static function remove($row_id)
    {
        // unset & save
        unset(self::$cartContents[$row_id]);
        self::saveCart();
        return true;
    }

    /**
          * Destroy the cart: Empties the cart and destroy the session
          * @return    void
    */
    public static function destroy()
    {
        self::$cartContents = ['cart_total' => 0, 'total_items' => 0];
        unset($_SESSION['cart_contents']);
    }

    /**
          * Get Item Category: Returns the current item category
          * @return    string
    */
    public static function getItemCategory()
    {
        /* if ($this->data->url()[2]) {
            if ($this->data->url()[2] == 'category') {
                $this->category = ucfirst($this->data->url()[3]);
            } else {
                $this->category = 'Gear';
            }
        } */
        self::$category = (!empty(Data::url()[2]) && Data::url()[2] === 'category') ? Data::url()[3] : 0;
        /* if (isset($_GET['category'])) {
            $this->category = ucfirst($_GET['category']);
        } else {
            $this->category = 'Gear';
        } */
    }

    public static function getItemCategoryName()
    {
        return (!empty(Data::url()[2]) && Data::url()[2] === 'category') ? WEBMALL['categories'][Data::url()[3]] : WEBMALL['categories'][0];
    }

    /**
          * Get User Points: Returns the current users points
          * @return    string
    */
    public static function getUserPoints()
    {
        if (isset($_SESSION['User'])) {
            $res    =   WebmallDB::__get_UserPoint($_SESSION['User']['UserUID']);

            return $res->Point;
        }
    }

    /**
          * Get User Guild Points: Returns the current users guild points
          * @return    string
    */
    public static function getUserGuildPoints()
    {
        if (User::isLoggedIn()) {
            $charID = User::getCharIdFromUser($_SESSION['User']['UserUID']);
            if (User::isCharInGuild($charID)) {
                if (isset($_SESSION['User'])) {
                    $guildID = User::getGuildFromChar($charID);

                    $res = DB::table(table('shGuilds'))
                    ->select('GuildPoint')
                    ->where('GuildID', $guildID)
                    ->limit(1)
                    ->get();
                    return $res[0]->GuildPoint;
                }
            }
        }
    }

    /**
          * Get Products: Returns the current products in category
          * @return    string
    */
    public function getProducts()
    {
        $res = DB::table(table('products'))
            ->select()
            ->where('Category', self::$category)
            ->where('Main', true)
            ->orderBy('ProductID', 'DESC')
            ->get();

        return $res;
    }

    /**
          * Get Product Name: Returns the product name
          * @return    string
    */
    public function getProductName($id)
    {
        $name = DB::table(table('products'))
            ->where('ProductID', $id)
            ->value('ProductName');
        return $name;
    }

    /**
          * Get Tags: Returns if the product has a tag
          * @return    string
    */
    public function getTags($tag)
    {
        switch ($tag) {
            case 'Hot':
                $this->special = 'Hot!';
                break;
            case 'Promo':
                $this->special = 'Promo!';
                break;
            case 'New':
                $this->special = 'New!';
                break;
            case 'Sale':
                $this->special = 'Sale!';
                break;
        }
    }

    public function initCart()
    {
        if (!empty($_SESSION['cart'])) {
            $this->total = 0;
            $this->totalCount = 0;
        }
    }

    public function getOrderHistory()
    {
        $res = DB::table(table('orderHistory'))
            ->select()
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->orderBy('Date', 'DESC')
            ->get();
        return $res;
    }

    public function getNonStackableTypes()
    {
        // these item types can not be stacked.
        $types = [
            '16', '17', '18', '20', '21', // AoL Gears
            '67', '68', '70', '71', // AoL Gears
            '72', '73', '74', '76', '77', // AoL Gears
            '31', '32', '33', '35', '36', // UoF Gears
            '82', '83', '85', '86', // UoF Gears
            '87', '88', '89', '91', '92', // UoF Gears
            '1', '2', '5', '6', '7', '8', '9', // Weapons
            '10', '12', '13', '14', '15', '19', // Weapons
            '45', '46', '49', '51', '53', '55', // Weapons
            '57', '58', '60', '62', '64', '65', '69', // Weapons
            '3', '4', '11', '34', '47', '48', '50', // Weapons
            '52', '54', '56', '59', '61', '63', '84', // Weapons
            '22', // Rings
            '23', // Necklaces
            '40', // Loops
            //'30', // Lapis
            //'95', // Lapisia
            '24', // AoL Capes
            '39', // UoF Capes
            '42', // Mounts
        ];
        return $types;
    }

    public function getValidCurrencies()
    {
        //
        // valid currencies: dp, pvp points, play points/ active points, gp => guild point
        // if currency == ...
        $validCurrencies = [
            'dp',
            'pvp',
            'ap',
            'gp',
            'vip'
        ];
        return $validCurrencies;
    }

    public function getCurrency($product)
    {
        $currency = DB::table(table('products'))
            ->where('ProductID', $product)
            ->value('ProductCurrency');
        return $currency;
    }

    public function getDpPoints()
    {
        $res = DB::table(table('shUserData'))
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->value('Point');
        return $res;
    }

    public function getPvpPoints()
    {
        $res = DB::table(table('shUserData'))
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->value('PvpPoint');
        return $res;
    }

    public function getVipPoints()
    {
        $res = DB::table(table('shUserData'))
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->value('VipPoint');
        return $res;
    }

    /* public function getApPoints()
    {
        $res = DB::table(table('userPoints'))
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->value('apPoints');
        return $res;
    }

    public function getGpPoints()
    {
        $res = DB::table(table('userPoints'))
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->value('gpPoints');
        return $res;
    } */

    public function updateDpPoints($newPoints)
    {
        $res = DB::table(table('shUserData'))
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->update(['Point' => $newPoints]);
        return $res;
    }

    public function updatePvpPoints($newPoints)
    {
        $res = DB::table(table('shUserData'))
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->update(['PvpPoint' => $newPoints]);
        return $res;
    }

    public function updateVipPoints($newPoints)
    {
        $res = DB::table(table('shUserData'))
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->update(['VipPoint' => $newPoints]);
        return $res;
    }

    /* public function updateApPoints($newPoints)
    {
        $res = DB::table(table('userPoints'))
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->update(['apPoints' => $newPoints]);
        return $res;
    }

    public function updateGpPoints($newPoints)
    {
        $res = DB::table(table('userPoints'))
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->update(['gpPoints' => $newPoints]);
        return $res;
    } */

    public static function doesCouponCodeExist()
    {
        if (Session::has('WebMall', 'CouponCode')) {
            return Session::get('WebMall', 'CouponCode');
        }
    }

    public function getCouponData($code, $data)
    {
        $res = DB::table(table('productDiscounts'))
            ->where('CouponCode', $code)
            ->value($data);
        return $res;
    }
}
