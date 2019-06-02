<div class="navbar navbar-fixed-top scroll-hide">
    <div class="container-fluid top-bar">
        <div class="pull-right">
            <ul class="nav navbar-nav pull-right">
                
                
                <li class="dropdown user hidden-xs">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        GMCH User<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#">
                                <i class="fa fa-user"></i>My Account</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-gear"></i>Account Settings</a>
                        </li>
                        <li>
                            <a href="{{ url('logout') }}">
                                <i class="fa fa-sign-out"></i>Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="logo" href="{{ route('home') }}">GMCH</a>
    </div>
    <div class="container-fluid main-nav clearfix">
        <div class="nav-collapse">
            <ul class="nav">
                <li>
                    <a class="current" href="{{ route('home') }}"><span aria-hidden="true" class="hightop-home"></span>Dashboard</a>
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
                            <a href="{{ route('beneficary_details.reimbursement.beneficiary.create') }}">Add <strong>Discharge and TA</strong></a>
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


                        <li>
                            <a href="{{ route('beneficary_details.blood_test.create') }}">Add Beneficiary Blood Test</a>
                        </li>


                        <li>
                            <a href="{{ route('beneficary_details.icu.create') }}">Add Beneficiary ICU Charge</a>
                        </li>


                        <li>
                            <a href="{{ route('beneficary_details.bed_charge.create') }}">Add Beneficiary Bed Charge</a>
                        </li>


                        <li>
                            <a href="{{ route('beneficary_details.dialysis.create') }}">Add Beneficiary Dialysis Charge</a>
                        </li>

                        <li>
                            <a href="{{ route('beneficary_details.endorscopy.create') }}">Add Beneficiary Endorscopy Charge</a>
                        </li>

                        <li>
                            <a href="{{ route('beneficary_details.pet_ct.create') }}">Add PET-CT Charge</a>
                        </li>
                        

                        

                        
                    </ul>
                </li>
                <li class="dropdown">
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
                </li>
                
            </ul>
        </div>
    </div>
</div>