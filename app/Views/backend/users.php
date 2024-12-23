<!-- Container Start -->
<div class="page-wrapper">
    <div class="main-content align-items-start">

        <div class="ebook-table-content">
            <div class="ebook-table-container">
                <div class="ebook-headline-link">
                    <h4>Total <?=$usersTxt;?> (<?=isset($UserData)&&!empty($UserData)? count($UserData):'0';?>)</h4> 
                    <div class="ebook-button">
                        <a href="#delete"  class="ebook-btn ebook-disabled" id="users-delete-selected">Delete</a>
                        <a href="#addUser" class="ebook-btn" data-bs-toggle="modal" data-bs-target="#addUser">+ Add User</a>
                    </div>                   
                </div>
                <div class="ebook-sorting-table">
                <table id="UserTable" class="book-custom-table" cellspacing="0" width="100%" data-url="usertable">                   
                        <thead>
                            <tr>
                                <th class="export-col">
                                    <div class="ebook-checkbox">
                                        <input type="checkbox"  name="select_all" value="1" id="users-select-all">
                                        <span><!-- span has design  --></span>
                                    </div>                                    
                                </th>                          
                                <th>
                                    Name
                                </th>
                                <th>
                                    Email
                                </th>
                                <?php 
                                    if($cu_role==md5('adm')){?>
                                        <th class="export-col">
                                            Access Level
                                        </th>
                                    <?php }
                                ?>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php                      
                            $counter = 1;
                            foreach( $UserData as $row ){
                                
                                    $role = $row['user_role'] ==  md5('adm') ? "54#OUImdm4%4" : ($row['user_role'] == 2 ? ":()#$99rrtR" : "56&^^@##");
                                
                                    $checked = $row['user_status'] == 1 ? 'checked' : '';
                                    $userinfo = array( 'name' => $row['user_name'], 'email' => $row['user_email'], 'role' => $role, 'access_level' => $row['access_level'] );
                                    $data = json_encode($userinfo);
                            
                                    $user = get_userdata($row['ID']);
                                    ?>
                                        <tr data-userid="<?=$row['ID'];?>" data-userinfo='<?=$data;?>'>
                                    <?php                                    
                                    echo "<td>".$counter."</td>
                                        <td>
                                            <div class='ebook-table-team-name'>                                            
                                                ".$row['user_name']."
                                            </div>
                                        </td>
                                        <td>".$row['user_email']."</td>";
                                        if($cu_role==md5('adm')){
                                            $lev = str_replace(',', ', ', $row['access_level']);
                                            echo '<td><span class="ebook-user-budge">'.$lev.'</span></td>';
                                        }
                                        
                                        
                                        echo '<td>
                                                <div class="ebook-checkbox">
                                                    <input type="checkbox" class="ebook-user-status" id="ebook-user-status-'.$row['ID'].'" '.$checked.'>
                                                    <span for="ebook-user-status-'.$row['ID'].'"><!-- span has design  --></span>
                                                </div>                                            
                                        </td>';
                                        
                                        echo ' <td>
                                                <div class="ebook-table-action">
                                                    <a href="javascript:void(0);" class="ebook-action-icon">
                                                        <img src="assets/images/dots.svg" alt="">
                                                    </a>
                                                    <div class="ebook-table-dropdown">
                                                        <ul>
                                                            <li>
                                                                <a href="#editUser" data-bs-toggle="modal" data-bs-target="#editUser" class="user-edit-modal" data-id="'.$row['ID'].'">Edit</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="ebookremoveuser" data-id="'.$row['ID'].'">Remove</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                    </tr>';
                                    
                                $counter++;	
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
</div>

 <!-- Add user Modal -->
 <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addUserLabel">Add User</h5>
            <span class="modal-close" data-bs-dismiss="modal" aria-label="Close">
                <img src="assets/images/cross.svg" alt="">
            </span>
        </div>
        <form class="form">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ebook-input-feilds">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control require alphaField ebook-input" placeholder="Enter Name"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ebook-input-feilds">
                            <label>Email</label>
                            <input type="text" class="form-control require ebook-input" name="email" autocomplete="off" data-valid="email" data-error="Please enter a valid email." placeholder="Enter Email">   
                        </div>
                    </div>               
                    <div class="col-lg-12">
                        <div class="ebook-input-feilds">
                            <label>Enter or Generate Password</label>
                            <div class="ebook-pws-field">
                                <input type="text" name="password" autocomplete="off" placeholder="Enter Password" class="require ebook-input"/>
                                <a href="javascript:void(0);" class="ebook-generate-password"><img src="<?=base_url();?>assets/images/pws-generate.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ebook-input-feilds ebook-multi-select-wrap">
                            <label class="ebook-select-label">Access Level</label>
                            <ul class="ebook-multi-select">
                                <li>
                                    <div class="ebook-checkbox-lable ebook-input-value">
                                        <input name="access_level[]" type="checkbox" value="FE" class="ebook-plan" id="ebook-plan-FE">
                                        <label for="ebook-plan-FE">FE</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="ebook-checkbox-lable ebook-input-value">
                                        <input name="access_level[]" type="checkbox" value="OTO1" class="ebook-plan" id="ebook-plan-OTO1">
                                        <label for="ebook-plan-OTO1">OTO1</label>
                                    </div>
                                </li>
                                
                                <li>
                                    <div class="ebook-checkbox-lable">
                                        <input name="access_level[]" type="checkbox" value="OTO2" class="ebook-plan" id="ebook-plan-OTO2">
                                        <label for="ebook-plan-OTO2">OTO2</label>
                                    </div>
                                </li>
                                
                                <li>
                                    <div class="ebook-checkbox-lable">
                                        <input name="access_level[]" type="checkbox" value="OTO3" class="ebook-plan" id="ebook-plan-OTO3">
                                        <label for="ebook-plan-OTO3">OTO3</label>
                                    </div>
                                </li>
                                <?php if($cu_role==md5('adm')){?>
                                <li>
                                    <div class="ebook-checkbox-lable">
                                        <input name="access_level[]" type="checkbox" value="OTO4" class="ebook-plan" id="ebook-plan-OTO4">
                                        <label for="ebook-plan-OTO4">OTO4</label>
                                    </div>
                                </li>
                                
                                <li>
                                    <div class="ebook-checkbox-lable">
                                        <input name="access_level[]" type="checkbox" value="OTO5" class="ebook-plan" id="ebook-plan-OTO5">
                                        <label for="ebook-plan-OTO5">OTO5</label>
                                    </div>
                                </li>
                                
                                <li>
                                    <div class="ebook-checkbox-lable">
                                        <input name="access_level[]" type="checkbox" value="OTO6" class="ebook-plan" id="ebook-plan-OTO6">
                                        <label for="ebook-plan-OTO6">OTO6</label>
                                    </div>
                                </li>
                                
                                <li>
                                    <div class="ebook-checkbox-lable">
                                        <input name="access_level[]" type="checkbox" value="OTO7" class="ebook-plan" id="ebook-plan-OTO7">
                                        <label for="ebook-plan-OTO7">OTO7</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="ebook-checkbox-lable">
                                        <input name="access_level[]" type="checkbox" value="OTO8" class="ebook-plan" id="ebook-plan-OTO8">
                                        <label for="ebook-plan-OTO8">OTO8</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="ebook-checkbox-lable">
                                        <input name="access_level[]" type="checkbox" value="OTO9" class="ebook-plan" id="ebook-plan-OTO9">
                                        <label for="ebook-plan-OTO9">OTO9</label>
                                    </div>
                                </li> 
                                <?php } ?>                                  
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ebook-input-feilds">
                            <label class="ebook-select-label ebook-plan">Role</label>
                            <select name="user_role" class="ebook-input">                               
                                <?php if($cu_role==md5('adm')){?>
                                    <option value=":()#$99rrtR">User</option>
                                <?php }?>
                                <option value="56&^^@##">Sub User</option>										
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ebook-input-feilds">                            
                            <div class="ebook-checkbox">
                                <input type="checkbox" class="" name="send_email" id="ebook-user-sendmail" class="ebook-input">
                                <span for="ebook-user-sendmail">Send Mail</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="ebook-btn ebook-m-btn-dark" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="ebook-btn ebook-user-add" data-id="">Add +</button>
        </form>
        </div>
    </div>
    </div>
</div>


<!-- Edit user Modal -->
<div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="updateUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateUserLabel">Update User</h5>
                <span class="modal-close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="assets/images/cross.svg" alt="">
                </span>
            </div>
            <form class="form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="ebook-input-feilds">
                            <label>Name</label>
                            <input type="text" name="name" value="" class="form-control require alphaField ebook-input" placeholder="Enter Name"/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="ebook-input-feilds">
                                <label>Email</label>
                                <input type="text" value="" class="form-control require ebook-input" readonly name="email" autocomplete="off" data-valid="email" data-error="Please enter a valid email." placeholder="Enter Email">   
                            </div>
                        </div>               
                        <div class="col-lg-12">
                            <div class="ebook-input-feilds">
                                <label>Enter or Generate Password</label>
                                <div class="ebook-pws-field">
                                    <input type="text" name="password" autocomplete="off" placeholder="Enter Password" class="require ebook-input"/>
                                    <a href="javascript:void(0);" class="ebook-generate-password"><img src="<?=base_url();?>assets/images/pws-generate.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="ebook-input-feilds ebook-multi-select-wrap">
                                <label class="ebook-select-label">Access Level</label>
                                <ul class="ebook-multi-select">
                                    <li>
                                        <div class="ebook-checkbox-lable ebook-input-value">
                                            <input name="access_level[]" type="checkbox" value="FE" class="ebook-plan" id="ebook-plan-FEu">
                                            <label for="ebook-plan-FEu">FE</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ebook-checkbox-lable ebook-input-value">
                                            <input name="access_level[]" type="checkbox" value="OTO1" class="ebook-plan" id="ebook-plan-OTO1u">
                                            <label for="ebook-plan-OTO1u">OTO1</label>
                                        </div>
                                    </li>
                                    
                                    <li>
                                        <div class="ebook-checkbox-lable">
                                            <input name="access_level[]" type="checkbox" value="OTO2" class="ebook-plan" id="ebook-plan-OTO2u">
                                            <label for="ebook-plan-OTO2u">OTO2</label>
                                        </div>
                                    </li>
                                    
                                    <li>
                                        <div class="ebook-checkbox-lable">
                                            <input name="access_level[]" type="checkbox" value="OTO3" class="ebook-plan" id="ebook-plan-OTO3u">
                                            <label for="ebook-plan-OTO3u">OTO3</label>
                                        </div>
                                    </li>
                                    <?php if($cu_role==md5('adm')){?>
                                    <li>
                                        <div class="ebook-checkbox-lable">
                                            <input name="access_level[]" type="checkbox" value="OTO4" class="ebook-plan" id="ebook-plan-OTO4u">
                                            <label for="ebook-plan-OTO4u">OTO4</label>
                                        </div>
                                    </li>
                                    
                                    <li>
                                        <div class="ebook-checkbox-lable">
                                            <input name="access_level[]" type="checkbox" value="OTO5" class="ebook-plan" id="ebook-plan-OTO5u">
                                            <label for="ebook-plan-OTO5u">OTO5</label>
                                        </div>
                                    </li>
                                    
                                    <li>
                                        <div class="ebook-checkbox-lable">
                                            <input name="access_level[]" type="checkbox" value="OTO6" class="ebook-plan" id="ebook-plan-OTO6u">
                                            <label for="ebook-plan-OTO6u">OTO6</label>
                                        </div>
                                    </li>
                                    
                                    <li>
                                        <div class="ebook-checkbox-lable">
                                            <input name="access_level[]" type="checkbox" value="OTO7" class="ebook-plan" id="ebook-plan-OTO7u">
                                            <label for="ebook-plan-OTO7u">OTO7</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ebook-checkbox-lable">
                                            <input name="access_level[]" type="checkbox" value="OTO8" class="ebook-plan" id="ebook-plan-OTO8u">
                                            <label for="ebook-plan-OTO8u">OTO8</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ebook-checkbox-lable">
                                            <input name="access_level[]" type="checkbox" value="OTO9" class="ebook-plan" id="ebook-plan-OTO9u">
                                            <label for="ebook-plan-OTO9u">OTO9</label>
                                        </div>
                                    </li>  
                                    <?php } ?>                                 
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="ebook-input-feilds">
                                <label class="ebook-select-label">Role</label>
                                <select name="user_role" class="ebook-input">
                                    <option value=":()#$99rrtR">User</option>
                                    <option value="56&^^@##">Sub User</option>										
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="ebook-input-feilds">                            
                                <div class="ebook-checkbox">
                                    <input type="checkbox" class="" name="send_email" id="ebook-user-sendmail" class="ebook-input">
                                    <span for="ebook-user-sendmail">Send Mail</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="ebook-btn ebook-user-update" id="ebook-update-user">Update</button>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- delete  popup -->
<div class="modal fade ebook-delete-modal" id="deleteConfirmModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <span class="modal-close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="<?=base_url();?>assets/images/cross.svg" alt="">
                </span>
                <img src="<?=base_url();?>assets/images/delete.svg" alt="">
                <h5 class="modal-title">Confirm Deletion</h5>
                <p>This action will permanently remove the item and cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="ebook-btn ebook-m-btn-dark" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="ebook-btn ebook-remove-user" id="ebook-remove-user">Delete</button>
            </div>
        </div>
    </div>
</div>