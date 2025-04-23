<?php require('private/header.php');
?>

<body>
	<div class="bg-white shadow-sm p-3">
		<div class="d-flex align-items-center">
			<div class="gap-3 d-flex align-items-center">
				<a href="main"><i class="bi bi-arrow-left d-flex krishisampark-text h2 m-0 back-page"></i></a>
				<h3 class="fw-bold m-0"><?=getLanguageString($con,$lang,'switch_to_seller');?></h3>
			</div>
		</div>
	</div>
	
	
  
    
	<div class='text-center p-4'>
		<h3 class="fw-bold pb-2">"Unlock the power to sell animals and grow your business on our platform. List your offerings and reach a wider audience as a seller today!"</h3>
		<div class="row g-2 text-center">
			<div class="col-12">
			    <a href="#" class='text-white'>
				<div class="text-decoration-none text-white">
				    
					<div class="krishisampark-bg p-3 rounded-md  switch-button">
						<h4 class="fw-bold mb-1"><?=getLanguageString($con,$lang,'switch_now');?></h4>
						<p class="small m-0">Go&nbsp;
							<a class="text-decoration-none text-white"><i class="fa-solid fa-arrow-right"></i></a>
						</p>
					</div>
				</div>
				</a>
			</div>
			 
		
				
		</div>
		</div>
		
	 <script>
$(document).ready(function() {
    $('.switch-button').on('click', function(e) {
        e.preventDefault();
        var adId = $(this).data('id');

        Swal.fire({
            title: 'Switch to Seller',
            text: 'Unlock the power to sell animals and grow your business on our platform. List your offerings and reach a wider audience as a seller today!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#08811c',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, switch now!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'switch.php'; 
            }
        });
    });
});
</script>
		
	<?php require('private/footer.php');?>