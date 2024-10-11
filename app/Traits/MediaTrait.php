<?php

namespace App\Traits;
use Str;

use Illuminate\Http\Request;

trait MediaTrait {

    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function verifyAndUpload(Request $request, $fieldname, $directory) {

        if( $request->hasFile( $fieldname ) ) {

            if (!$request->file($fieldname)->isValid()) {

                flash('Invalid File!')->error()->important();

                return redirect()->back()->with('error', 'Invalid File.');

            }

            $filename = time().Str::random(5).'.'.$request->file($fieldname)->getClientOriginalExtension();
            $filepath = $request->file($fieldname)->storeAs('public/'.$directory,$filename);

            return $filepath;

        }

        return null;

    }

}