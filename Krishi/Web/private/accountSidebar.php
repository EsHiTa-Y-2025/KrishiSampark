                
                <div class="edit-profile-photo text-center p-3">
                    <img src="<?=$baseurl;?>img/user.png" alt="profile-photo" style='width:100px' class="img-fluid">
                    <h4 class='mt-2'><?=$userData->name;?>
                    <?php if($userData->is_verified){ ?>
                                    <img src="<?=$baseurl;?>img/verified.png" style="width:17px;margin-bottom:5px"></a>
                                    <?php } ?>
                    </h4>
                    <?php if($userData->plan!=NULL){ ?>
                    <p>Plan : <?=$userData->plan;?></p>
                    <?php } ?>
                    
                </div>
                <div class="my-account-box">
                    <ul>
                        <li>
                            <a href="<?=$baseurl;?>account" class="<?php if(isset($account)) echo 'active';?>">
                                <i class="flaticon-people"></i>My Profile
                            </a>
                        </li>
                       
                        <li>
                            <a href="<?=$baseurl;?>my-ads" class="<?php if(isset($myAds)) echo 'active';?>">
                                <i class="flaticon-internet"></i>My Properties
                            </a>
                        </li>
                        
                        <!--<li>-->
                             <?php // if($isSubmitted){
                            ?>
                            <!-- <a href="<?=$baseurl;?>view-business" class="<?php if(isset($viewBusiness)) echo 'active';?>">-->
                            <!--    <i class="fa fa-briefcase"></i>View Business-->
                            <!--</a>-->
                            <?php
                        // }else{ ?>
                            <!-- <a href="<?=$baseurl;?>add-business" class="<?php if(isset($viewBusiness)) echo 'active';?>">-->
                            <!--    <i class="fa fa-briefcase"></i>Add Business-->
                            <!--</a>-->
                        <?php // } ?>
                        
                           
                        <!--</li>-->
                      
                        <li>
                            <a href="<?=$baseurl;?>leads" class="<?php if(isset($leads)) echo 'active';?>">
                                <i class="fa fa-bar-chart"></i>Business Leads
                            </a>
                        </li>
                        <!--<li>-->
                        <!--    <a href="<?=$baseurl;?>change-password"  class="<?php if(isset($changePassword)) echo 'active';?>">-->
                        <!--        <i class="fa fa-lock"></i>Change Password-->
                        <!--    </a>-->
                        <!--</li>-->
                        <li>
                            <a href="<?=$baseurl;?>logout">
                                <i class="flaticon-exit"></i>Log Out
                            </a>
                        </li>
                    </ul>
                </div>