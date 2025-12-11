<?php

namespace App\Interface\SuperAdmin;



interface SuperAdminInterface
{
    public function index();
    public function get_all_departments();
    public function get_all_employees();
    public function get_all_present_employees();
    public function get_all_absent_employees();
    public function get_all_lats_employees();
    public function get_one_department($id);
    public function update_department($request,$id);
    public function delete_department($request);
    public function add_department($request);
    public function create_department();

    //============================= Emlpoyee ===================================//
    public function show_employee_date($id);
    public function get_form_creation();
    public function add_employee_data($request);
    public function edit_employee($id);
    public function delete_employee($request);
    public function update_employee($request,$id);

    //=========================== Attendences ==================================//
    public function report($request);
    public function export();


    // ========================== LeavesBalance ====================================//

    public function get_all_leaves();

}
