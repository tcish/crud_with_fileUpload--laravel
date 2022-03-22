<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\conTable;

class loginRegister extends Controller {
    function forRegister(Request $req) {
        $req->validate([
            "name" => "required|min:4",
            "username" => "required",
            "email" => "required|email",
            "image" => "required|max:1024",
            "password" => "required"
        ],[
            "name.required" => "Please Enter Your Name!",
            "username.required" => "Please Enter Your Username!",
            "email.required" => "Please Enter Your E-mail!",
            "email.email" => "E-mail Must Be Valid!",
            "image.required" => "Please Select An Image!",
            "image.mimes" => "Only jpg, jpeg, png, gif, svg Are Allowed!",
            "image.max" => "Image Size Must Be Within 1MB!",
            "password.required" => "Please Enter Your Password!"
        ]);

        //Get image name with extension
        $imageNameWithExt = $req->file("image")->getClientOriginalName();
        //Get just image name
        $imageName = pathinfo($imageNameWithExt. PATHINFO_FILENAME);
        //Get just extension
        $fileExt = $req->file("image")->getClientOriginalExtension();
        //Make random image name to store
        $imageNameToStore = rand(1000000000, 1000).'.'.$fileExt;

        $result = DB::table("tbl_log_reg")->where("email", $req->input("email"))->get();
        if(isset($result[0]->id)) {
            $req->session()->flash("msg", "E-mail You Have Enter Already Taken!");
            return redirect("register");
        }else {
            $insert = new conTable;
            $insert->name = $req->input("name");
            $insert->username = $req->input("username");
            $insert->email = $req->input("email");
            $insert->image = $imageNameToStore;
            //save in local storage
            $req->file("image")->move("img/", $imageNameToStore);
            $insert->password = md5($req->input("password"));
            $insert->save();

            $req->session()->flash("msg", "You Have Been Registered.");
            return redirect("register");
        }
    }

    function forlogin(Request $req) {
        $req->validate([
            "email" => "required|email",
            "password" =>  "required"
        ],[
            "email.required" => "Please Enter Your E-mail!",
            "email.email" => "E-mail You Have Been Given Is Not a Valid E-mail Address!",
            "password.required" => "Please Enter Your Password!"
        ]);

        $result = DB::table("tbl_log_reg")
        ->where("email", $req->input("email"))
        ->where("password", md5($req->input("password")))
        ->get();
        if(isset($result[0]->id)) {
            $req->session()->put("USER_ID", $result[0]->id);
            $req->session()->put("USER_NAME", $result[0]->username);

            $req->session()->flash("login_msg", "Success You are Loged In!");
            return redirect("index");
        }else {
            $req->session()->flash("msg", "Incorrect E-mail or Password!");
            return redirect("/");
        }
    }

    function logout() {
        session()->forget("USER_ID");
        session()->forget("USER_NAME");
        return redirect("/");
    }

    function index() {
        return view("index")->with("data", DB::table("tbl_log_reg")->get());
    }

    function profile($id) {
        return view("profile")->with("getById", DB::table("tbl_log_reg")->find($id));
    }

    function profileUpdate(Request $request, $id) {
        $request->validate([
            "name" => "required",
            "username" => "required",
            "email" => "required|email",
            "image" => "max:1024",
        ],[
            "name.required" => "Please Enter Your Name!",
            "username.required" => "Please Enter Your Username!",
            "email.required" => "Please Enter Your E-mail!",
            "email.email" => "E-mail Must Be Valid!",
            "image.max" => "Image Size Must Be WIthin 1MB!",
        ]);
        if($request->hasFile("image")) {
            //Get image name with extension
            $imageNameWithExt = $request->file("image")->getClientOriginalName();
            //Get just image name
            $imageName = pathinfo($imageNameWithExt. PATHINFO_FILENAME);
            //Get just extension
            $fileExt = $request->file("image")->getClientOriginalExtension();
            //Make random image name to store
            $imageNameToStore = rand(1000000000, 1000).'.'.$fileExt;
            //save in local storage
            $request->file("image")->storeAs("public/here", $imageNameToStore);
        }
        $update = conTable::find($id);
        $update->name = $request->input("name");
        $update->username = $request->input("username");
        $update->email = $request->input("email");
        if($request->hasFile("image")) {
            $update->image = $imageNameToStore;
        }
        $update->save();

        $request->session()->flash("msg", "Data Updated Sucessfully!");
        return redirect("profile/$id");
    }

    function changePass($id) {
        return view("passUpdate")->with("getId", DB::table("tbl_log_reg")->find($id));
    }

    function updatePass(Request $req, $id) {
        $req->validate([
            "oldPass" => "required",
            "newPass" => "required"
        ],[
            "oldPass.required" => "Please Enter Your Old Password!",
            "newPass.required" => "Please Enter Your New Password"
        ]);

        $result = DB::table("tbl_log_reg")
        ->where("password", md5($req->input("oldPass")))
        ->where("id", $id)
        ->get();
        if(isset($result[0]->id)) {
            $update = conTable::find($id);
            $update->password = md5($req->input("newPass"));
            $update->save();

            $req->session()->flash("msg", "Password Updated!");
            return redirect("changePass/$id");
        }else {
            $req->session()->flash("msg", "Old Password Dosen't Match!");
            return redirect("changePass/$id");
        }
    }
}