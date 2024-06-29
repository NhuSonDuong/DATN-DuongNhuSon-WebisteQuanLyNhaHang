<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class CustomerController extends Controller
{
    public function index(){
        // truy vấn lấy các bản ghi có role = 0(khách hàng)
        $users = User::where('role', 0)->orderBy('created_at', 'desc')->paginate(10);
        $totalPages = $users->lastPage(); // Lấy tổng số trang
        return view('Admin/Customer/index', compact('users', 'totalPages'));
    }

    public function show($id){
        try{
            //tìm kiếm user với id và role = 0, return kết quả đầu tiên nếu tìm thấy: còn lại là exception
            $user = User::where('id', $id)->where('role', 0)->firstOrFail();
            return view('Admin/Customer/block', compact('user')); 
        } catch (\Exception $e) {
            return redirect()->route('admin.customer.index')->with('error', 'Không tìm thấy khách hàng!');
        }
    }

    public function block($id){
        try{
            $user = User::where('id', $id)->where('role', 0)->firstOrFail();
            //nếu là true thì status = 0 sẽ trả giá trị là 1, flase status = 0 sẽ trả giá trị là 0
            $status = $user->status == 0 ? 1 : 0;
            // gắn $status mới của thuộc tính status
            $user->status = $status;
            $user->save();
            return redirect()->route('admin.customer.block', $user->id)->with('success', 'Cập nhật trạng thái khách hàng thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.customer.index')->with('error', 'Không tìm thấy khách hàng!');
        }
    }
}
