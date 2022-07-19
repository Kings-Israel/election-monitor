<?php

namespace App\Http\Controllers\Api\V1;

use App\UserCode;
use Illuminate\Http\Request;
use DB;

class AnnouncementController extends APIController
{


    /**
     * store announcement
     *
     * @return response()
     */
    public function store(Request $request)
    {
	 $save = DB::table('announcements')->insert(
	    ['title' => $request->input('title'),
	     'description' => $request->input('description')]
	);
	
	if ($save){
         return response()->json(['status' => 'Successful','message' => 'Announcement saved successfully']);
        }else {
         return response()->json(['status' => 'Failed','message' => 'Announcement was not saved']);
         }
         
    } /**
     * fetch announcements
     *
     * @return response()
     */
    public function fetch()
    {
	 $announcements = DB::table('announcements')->get();
	
	if ($announcements){
         return response()->json(['status' => 'Successful','message' => 'Surveys fetched successfully', 'data' => $announcements]);
        }else {
         return response()->json(['status' => 'Failed','message' => 'Surveys not fetched']);
         }
         
    }

     /**
     * fetch announcements
     *
     * @return response()
     */
    public function fetchByID($id)
    {
	 $announcements = DB::table('announcements')->where('id', $id)->get();
	
	if ($announcements){
         return response()->json(['status' => 'Successful','message' => 'Surveys fetched successfully', 'data' => $announcements]);
        }else {
         return response()->json(['status' => 'Failed','message' => 'Surveys not fetched']);
         }
         
    }
    /**
     * delete announcement
     *
     * @return response()
     */
    public function delete(Request $request, $id)
    {
       $delete =  DB::table('announcements')->delete($id);
  
        if ($delete){
         return response()->json(['status' => 'Successful','message' => 'Announcement deleted successfully']);
		}else {
		 return response()->json(['status' => 'Failed','message' => 'Announcement was not deleted']);
		 }
         
    }
    
    /**
     * update announcement
     *
     * @return response()
     */
    public function update(Request $request, $id)
    {
       $update = DB::table('announcements')->where('id', $id)->update([
        'title' => $request->input('title'),
        'description' => $request->input('description')
    ]);
  
        if ($update){
         return response()->json(['status' => 'Successful','message' => 'Announcement updated successfully']);
		}else {
		 return response()->json(['status' => 'Failed','message' => 'Announcement was not updated']);
		 }
         
    }

    
}
