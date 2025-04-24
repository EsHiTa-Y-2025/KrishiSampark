        
            <div class="col-lg-4 col-md-12">
                <div class="sidebar-right">
                    
                    <!--<div class="widget">-->
                    <!--    <img src="https://smallseotools.com/designstudio/images/poster/postr_1.png">-->
                    <!--</div>-->
                   
                    <div class="posts-by-category widget">
                        <h3 class="sidebar-title">Business Category</h3>
                        <ul class="list-unstyled list-cat">
                            <?php foreach($categories as $cat){ ?>
                                <li><a href="<?=$baseurl;?>category/<?=$cat->subcategory_slug;?>"><?=$cat->subcategory_name;?> </a></li>
                            <?php } ?>
                           
                        </ul>
                    </div>
                    
                    <div class="widget helping-center">
                        <h3 class="sidebar-title">Helping Center</h3>
                        <ul class="contact-link">
                            <li>
                                <i class="flaticon-location"></i>
                                Dharwad, Hubbali
                            </li>
                            <li>
                                <i class="flaticon-technology-1"></i>
                                <a href="tel:+919738207273">
                                    +91 9738207273
                                </a>
                            </li>
                            <li>
                                <i class="flaticon-envelope"></i>
                                <a href="mailto:connect@landsbazzar.com">
                                    connect@landsbazzar.com
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </div>