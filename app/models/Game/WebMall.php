<?php

namespace App\Models\Game;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class WebMall
{
    public $name;
    public $code;
    public $quantity;
    public $cost;
    public $category;
    public $special;
    public $getPoints;
    public $newPoints;
    public $total;
    public $totalCount;
    public $subTotal;
    public $slot;
    public $maxSlot;
    public $fet;
    public $fetCount;
    protected $cartContents = [];

    public function __construct()
    {
        $this->data = new \Classes\Utils\Data;
        $this->session = new Utils\Session;
        $this->user = new Utils\User($this->session);
        $this->user->run();

        $this->getItemCategory();
        $this->getUserPoints();
        //$this->getUserGuildPoints();
        // get the shopping cart array from the session
        $this->cartContents = !empty($_SESSION['cart_contents']) ? $_SESSION['cart_contents'] : null;
        if ($this->cartContents === null) {
            // set some base values
            $this->cartContents = ['cart_total' => 0, 'total_items' => 0];
        }
    }

    /**
          * Cart Contents: Returns the entire cart array
          * @param    bool
          * @return    array
    */
    public function contents()
    {
        // rearrange the newest first
        $cart = array_reverse($this->cartContents);

        // remove these so they don't create a problem when showing the cart table
        unset($cart['total_items'], $cart['cart_total']);

        return $cart;
    }

    /**
          * Get cart item: Returns a specific cart item details
          * @param    string    $row_id
          * @return    array
    */
    public function getItem($row_id)
    {
        return (in_array($row_id, ['total_items', 'cart_total'], true) or !isset($this->cartContents[$row_id]))
            ? false
            : $this->cartContents[$row_id];
    }

    /**
          * Total Items: Returns the total item count
          * @return    int
    */
    public function totalItems()
    {
        return $this->cartContents['total_items'];
    }

    /**
          * Cart Total: Returns the total price
          * @return    int
    */
    public function total()
    {
        if ($this->doesCouponCodeExist()) {
            //TODO: add min order value and max discount requirements
            $type = $this->getCouponData($this->session->get('WebMall', 'CouponCode'), 'Type');
            $value = $this->getCouponData($this->session->get('WebMall', 'CouponCode'), 'Value');
            if ($type == 'Percentage') {
                $total =  $this->cartContents['cart_total'] - ($this->cartContents['cart_total'] * ((int)($value)/100));
                $this->cartContents['cart_total'] = $total;
            } elseif ($type = 'Fixed') {
                $total =  $this->cartContents['cart_total'] - ((int)($value));
                $this->cartContents['cart_total'] = $total;
            }
            return $this->cartContents['cart_total'];
        } else {
            return $this->cartContents['cart_total'];
        }
    }

    /**
          * Insert items into the cart and save it to the session
          * @param    array
          * @return    bool
    */
    public function insert($item = [])
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
                $old_qty = isset($this->cartContents[$rowid]['qty']) ? (int) $this->cartContents[$rowid]['qty'] : 0;
                // re-create the entry with unique identifier and updated quantity
                $item['rowid'] = $rowid;
                $item['qty'] += $old_qty;
                $this->cartContents[$rowid] = $item;

                // save Cart Item
                if ($this->saveCart()) {
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
    public function update($item = [])
    {
        if (!is_array($item) or count($item) === 0) {
            return false;
        } else {
            if (!isset($item['rowid'], $this->cartContents[$item['rowid']])) {
                return false;
            } else {
                // prep the quantity
                if (isset($item['qty'])) {
                    $item['qty'] = (float) $item['qty'];
                    // remove the item from the cart, if quantity is zero
                    if ($item['qty'] == 0) {
                        unset($this->cartContents[$item['rowid']]);
                        return true;
                    }
                }

                // find updatable keys
                $keys = array_intersect(array_keys($this->cartContents[$item['rowid']]), array_keys($item));
                // prep the price
                if (isset($item['price'])) {
                    $item['price'] = (float) $item['price'];
                }
                // product id & name shouldn't be changed
                foreach (array_diff($keys, ['id', 'name']) as $key) {
                    $this->cartContents[$item['rowid']][$key] = $item[$key];
                }
                // save cart data
                $this->saveCart();
                return true;
            }
        }
    }

    /**
          * Save the cart array to the session
          * @return    bool
    */
    protected function saveCart()
    {
        $this->cartContents['total_items'] = $this->cartContents['cart_total'] = 0;
        foreach ($this->cartContents as $key => $val) {
            // make sure the array contains the proper indexes
            if (!is_array($val) or !isset($val['price'], $val['qty'])) {
                continue;
            }

            $this->cartContents['cart_total'] += ($val['price'] * $val['qty']);
            $this->cartContents['total_items'] += $val['qty'];
            $this->cartContents[$key]['subtotal'] = ($this->cartContents[$key]['price'] * $this->cartContents[$key]['qty']);
        }

        // if cart empty, delete it from the session
        if (count($this->cartContents) <= 2) {
            unset($_SESSION['cart_contents']);
            return false;
        } else {
            $_SESSION['cart_contents'] = $this->cartContents;
            return true;
        }
    }

    /**
          * Remove Item: Removes an item from the cart
          * @param    int
          * @return    bool
    */
    public function remove($row_id)
    {
        // unset & save
        unset($this->cartContents[$row_id]);
        $this->saveCart();
        return true;
    }

    /**
          * Destroy the cart: Empties the cart and destroy the session
          * @return    void
    */
    public function destroy()
    {
        $this->cartContents = ['cart_total' => 0, 'total_items' => 0];
        unset($_SESSION['cart_contents']);
    }

    /**
          * Get Item Category: Returns the current item category
          * @return    string
    */
    public function getItemCategory()
    {
        /* if ($this->data->url()[2]) {
            if ($this->data->url()[2] == 'category') {
                $this->category = ucfirst($this->data->url()[3]);
            } else {
                $this->category = 'Gear';
            }
        } */
        $this->category = (!empty($this->data->url()[2]) && $this->data->url()[2] === 'category') ? ucfirst($this->data->url()[3]) : 'Gear';
        /* if (isset($_GET['category'])) {
            $this->category = ucfirst($_GET['category']);
        } else {
            $this->category = 'Gear';
        } */
    }

    /**
          * Get User Points: Returns the current users points
          * @return    string
    */
    public function getUserPoints()
    {
        if (isset($_SESSION['User'])) {
            $res = DB::table(table('shUserData'))
            ->select()
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->limit(1)
            ->get();
            return $res[0]->Point;
        }
    }

    /**
          * Get User Guild Points: Returns the current users guild points
          * @return    string
    */
    public function getUserGuildPoints()
    {
        if ($this->user->isLoggedIn()) {
            $charID = $this->user->getCharIdFromUser($_SESSION['User']['UserUID']);
            if ($this->user->isCharInGuild($charID)) {
                if (isset($_SESSION['User'])) {
                    $guildID = $this->user->getGuildFromChar($charID);

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
            ->where('Category', $this->category)
            ->orderBy('ProductID', 'DESC')
            ->get();
        return $res;
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
            'gp'
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
        $res = DB::table(table('userPoints'))
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->value('pvpPoints');
        return $res;
    }

    public function getApPoints()
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
    }

    public function updateDpPoints($newPoints)
    {
        $res = DB::table(table('shUserData'))
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->update(['Point' => $newPoints]);
        return $res;
    }

    public function updatePvpPoints($newPoints)
    {
        $res = DB::table(table('userPoints'))
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->update(['pvpPoints' => $newPoints]);
        return $res;
    }

    public function updateApPoints($newPoints)
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
    }

    public function doesCouponCodeExist()
    {
        if ($this->session->has('WebMall', 'CouponCode')) {
            return $this->session->get('WebMall', 'CouponCode');
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
