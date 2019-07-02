<div class="navbar navbar-fixed-top scroll-hide">
    <div class="container-fluid top-bar bluebar">
        <div class="pull-right">
            <ul class="nav navbar-nav pull-right">
                

                @if(Auth::user()->role == 'admin')
                <li class="dropdown user hidden-xs ">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        User Management
                        <b class="caret"></b></a>
                    <ul class="dropdown-menu bluebar">
                        <li>
                            <a href="{{ route('user.create') }}">
                                <i class="fa fa-plus" aria-hidden="true"></i> Create User</a>
                        </li>
                        <li>
                            <a href="{{ route('user.index') }}">
                                <i class="fa fa-bars" aria-hidden="true"></i> View All Users</a>
                        </li>
                    </ul>
                </li>
                @endif


                @if(Auth::user()->role == 'accountant')
                <li class="dropdown user hidden-xs bluebar">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        Honorarium 
                        <b class="caret"></b></a>
                    <ul class="dropdown-menu bluebar">
                        <li>
                            <a href="{{ route('honorarium.create') }}">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add Honorarium </a>
                        </li>
                        <li>
                            <a href="{{ route('honorarium.index') }}">
                                <i class="fa fa-bars" aria-hidden="true"></i> View All Honorarium</a>
                        </li>
                    </ul>
                </li>
                @endif



                <li class="dropdown user hidden-xs">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        {{ ucwords(Auth::user()->name) }}
                        <b class="caret"></b></a>
                    <ul class="dropdown-menu bluebar">
                        <li>
                            <a href="{{ route('change_password') }}">
                                <i class="fa fa-gear"></i>Change Password</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}">
                                <i class="fa fa-sign-out"></i>Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="logo" style="color: #FFF; font-size: 14px;" href="{{ route('home') }}">Guwahati Medical College</a>
        <div class="col-md-12" style="text-align: center; padding-top: 0.3%; font-size: 20px;"><span>Ayushman Bharat – Pradhan Mantri Jan Arogya Yojana</span></div>
    </div>
    <div class="container-fluid main-nav clearfix">
        <div class="nav-collapse">
            <ul class="nav">
                <li>
                    <a class="current" href="{{ route('home') }}"><span aria-hidden="true" class="hightop-home"></span>Dashboard</a>
                </li>

                <li class="dropdown">
                    <a data-toggle="dropdown" href="#">
                        <span aria-hidden="true" class="hightop-star"></span>PMJAY Beneficary Add Info<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        
                        <li>
                            <a href="{{ route('beneficary_details.investigation.create') }}">Add Investigations</a>
                        </li>
                        <li>
                            <a href="{{ route('beneficary_details.medicine.create') }}">Add Medicine Bill</a>
                        </li>
                        <li>
                            <a href="{{ route('beneficary_details.medicine_return.create') }}">Add Medicine Retuen Bill</a>
                        </li>
                        <li>
                            <a href="{{ route('beneficary_details.investigation.srl.create') }}">Add SRL Bill</a>
                        </li>
                        <li>
                            <a href="{{ route('beneficary_details.reimbursement.vendor.create') }}">Add Vendor Payment/Reimbursement</a>
                        </li>
                        <li>
                            <a href="{{ route('beneficary_details.reimbursement.beneficiary.create') }}">Add Beneficiary Reimbursement</a>
                        </li>

                        <li>
                            <a href="{{ route('beneficary_details.blood_transfusions.create') }}">Add Beneficiary Blood Transfusion Charge</a>
                        </li>


                        <li>
                            <a href="{{ route('beneficary_details.ot_charges.create') }}">Add Beneficiary OT Charge</a>
                        </li>


                        <!-- <li>
                            <a href="{{ route('beneficary_details.blood_test.create') }}">Add Beneficiary Blood Test</a>
                        </li> -->


                        <li>
                            <a href="{{ route('beneficary_details.icu.create') }}">Add Beneficiary ICU Charge</a>
                        </li>


                        <li>
                            <a href="{{ route('beneficary_details.bed_charge.create') }}">Add Beneficiary Bed Charge</a>
                        </li>


                        <li>
                            <a href="{{ route('beneficary_details.dialysis.create') }}">Add Beneficiary Dialysis Charge</a>
                        </li>

                        <!-- <li>
                            <a href="{{ route('beneficary_details.endorscopy.create') }}">Add Beneficiary Endorscopy Charge</a>
                        </li> -->

                        <li>
                            <a href="{{ route('beneficary_details.pet_ct.create') }}">Add PET-CT Charge</a>
                        </li>
                        
                    </ul>
                </li>

                <li class="dropdown">
                    <a data-toggle="dropdown" href="#">
                        <span aria-hidden="true" class="hightop-star"></span>PMJAY Beneficary Master<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('beneficary_details.view_all', ['scheme' => 'pmjay']) }}">View All Beneficiaries</a>
                        </li>
                        <li>
                            <a href="{{ route('beneficary_details.create') }}">Add New Beneficiary</a>
                        </li>

                        <li>
                            <a href="{{ route('beneficary_details.discharge_info.create') }}">Add <strong>Discharge and TA</strong></a>
                        </li>

                        <li>
                            <a href="{{ route('beneficary_details.create', ['hospital_type' => 'cancer_hospital']) }}">Add New Cancer Hospital Beneficiary</a>
                        </li>

                        <li>
                            <a href="{{ route('beneficary_details.create', ['hospital_type' => 'mmch']) }}">Add New MMCH Beneficiary</a>
                        </li>

                        
                    </ul>
                </li>

                

                <li class="dropdown">
                    <a data-toggle="dropdown" href="#">
                        <span aria-hidden="true" class="hightop-star"></span>PMJAY Reports<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        
                        <li>
                            <a href="{{ route('reports.pmjay.investigation') }}"> Investigations Reports</a>
                        </li>
                        <li>
                            <a href="{{ route('reports.pmjay.medicine') }}"> Medicine Bill Reports</a>
                        </li>
                        <li>
                            <a href="{{ route('reports.pmjay.medicine_return') }}"> Medicine Retuen Bill Reports</a>
                        </li>
                        <li>
                            <a href="{{ route('reports.pmjay.srl') }}"> SRL Bill Reports</a>
                        </li>
                        <li>
                            <a href="{{ route('reports.pmjay.vendor_reimbursement') }}"> Vendor Payment/Reimbursement Reports</a>
                        </li>
                        <li>
                            <a href="{{ route('reports.pmjay.beneficiary_reimbursement') }}">  Reimbursement Reports</a>
                        </li>

                        <li>
                            <a href="{{ route('reports.pmjay.blood_transfusions') }}">  Blood Transfusion Charge Reports</a>
                        </li>


                        <li>
                            <a href="{{ route('reports.pmjay.ot') }}">  OT Charge Reports</a>
                        </li>


                        <li>
                            <a href="{{ route('reports.pmjay.icu') }}">  ICU Charge Reports</a>
                        </li>


                        <li>
                            <a href="{{ route('reports.pmjay.bed') }}">  Bed Charge Reports</a>
                        </li>


                        <li>
                            <a href="{{ route('reports.pmjay.dialysis') }}">  Dialysis Charge Reports</a>
                        </li>

                        <li>
                            <a href="{{ route('reports.pmjay.pet_ct') }}"> PET-CT Charge Reports</a>
                        </li>

                        <li>
                            <a href="{{ route('reports.pmjay.beneficiary_discharge_report') }}">Beneficiary not discharged for > 45 Days</a>
                        </li>

                        <li>
                            <a href="{{ route('reports.pmjay.not_paid_sha') }}">Claim not received after discharge from SHA > 30 Days</a>
                        </li>
                        
                    </ul>
                </li>
                <!-- <li class="dropdown">
                    <a data-toggle="dropdown" href="#">
                        <span aria-hidden="true" class="hightop-feed"></span>Atal Amrit Abhiyan<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ asset('se7en/buttons.html">Buttons</a>
                        </li>
                        <li>
                            <a href="{{ asset('se7en/fontawesome.html">Font Awesome Icons</a>
                        </li>
                        <li>
                            <a href="{{ asset('se7en/glyphicons.html">Glyphicons</a>
                        </li>
                        <li>
                            <a href="{{ asset('se7en/components.html">Components</a>
                        </li>
                        <li>
                            <a href="{{ asset('se7en/widgets.html">Widgets</a>
                        </li>
                        <li>
                            <a href="{{ asset('se7en/nestable-lists.html">Nestable Lists</a>
                        </li>
                        <li>
                            <a href="{{ asset('se7en/typo.html">Typography</a>
                        </li>
                        <li>
                            <a href="index.html">Grid Layout</a>
                        </li>
                    </ul>
                </li> -->
                
            </ul>
        </div>
    </div>
</div>