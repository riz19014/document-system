<?php
namespace App\Classes;

use App\Models\DmAudit;
use Auth;
use Request;

class Audits {
  public static function getAudit($params) {
    $current_time = \Carbon\Carbon::now();

        $audit = new DmAudit();
        $audit->date = $current_time;
        $audit->user = Auth::id();
        $audit->object_type = $params['objtype'];
         $audit->object_id = $params['obj_id'];
        $audit->object = $params['obj'];
        $audit->action = $params['action'];
        $audit->save();
        return 1;

    // return ['bronze' => 50, 'silver' => 100, 'gold' => 150];
  }
}
