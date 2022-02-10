<?php $countItems = ceil(count($librosSS) / 2); $actual = 0; $libros_por_slide = 2; ?>

<div class="container">
	<div class="row">
		<div class="col d-flex justify-content-center align-items-center p-0 m-0">
			<div class="carousel slide" style="max-width:1100px;" id="slider" data-ride="carousel">
				<ol class="carousel-indicators">					
					<?php for($i = 0; $i < $countItems; $i++): ?>
						<?php if($i === 0): ?>
						<li data-target="#slider" data-slide-to="<?php echo $i; ?>" class="active"></li>
						<?php else: ?>
						<li data-target="#slider" data-slide-to="<?php echo $i; ?>"></li>
						<?php endif; ?>
					<?php endfor; ?>
				</ol>
				<div class="carousel-inner">
					<?php for($i = 0; $i < $countItems; $i++): ?>
						<?php if($i === 0): ?>
						<div class="carousel-item active">
						<?php else: ?>
						<div class="carousel-item">
						<?php endif; ?>												
							<div class="row p-4 cover">
								<?php for($x = 0; $x < $libros_por_slide; $x++): ?>
								<div class="col">
									<div class="row d-flex justify-content-center align-items-center">
										<div class="col-auto">
											<a href="single.php?lib=<?php echo $librosSS[$actual]['id']; ?>" class="portada">
												<img src="<?php echo $book_config['carpeta_portadas'] . $librosSS[$actual]['portada']; ?>" height="280px"/>
											</a>
										</div>
										<div class="col text-white">
											<p class="titulo-libro"><?php echo $librosSS[$actual]['nombre']; ?></p>
											<p class="autor-libro">Por <?php echo $librosSS[$actual]['autor']; ?></p>
											<p class="descripcion-libro"><?php echo $librosSS[$actual]['extracto']; ?></p>                   
											<a href="single.php?lib=<?php echo $librosSS[$actual]['id']; ?>" class="btn btn-outline-light w-100"><b>Ver Libro</b></a>
										</div>
										<img src="<?php echo $book_config['carpeta_portadas'] . $librosSS[$actual]['thumb']; ?>" class="filter" width="510px" height="330px">
									</div>							
								</div>
								<?php $actual++; ?>
								<?php endfor; ?>
							</div>			
						</div>
					<?php endfor; ?>
				</div>				
			</div>	
			
			<a href="#slider" class="carousel-control-prev bg-dark d-flex" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Anterior</span>
			</a>
			<a href="#slider" class="carousel-control-next bg-dark" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Siguiente</span>
			</a>				
		</div>	
	</div>
</div>