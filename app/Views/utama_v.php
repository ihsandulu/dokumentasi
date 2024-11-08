<?php echo $this->include("template/header_v"); ?>

<div class='container'>
	<div class='row'>
		<div class='col'>
			<div class="row">
				<!-- Column -->
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<div class="card-two">
								<header>
									<div class="avatar">
										<img src="images/global/user.png" alt="<?= session()->get("user_name"); ?>" />
									</div>
								</header>
								<h3><?= session()->get("position_name"); ?></h3>
								<div class="desc">
									<?= session()->get("store_name"); ?>
								</div>
								<!-- <div class="contacts"><?= session()->get("position_name"); ?>
									<div class="clear"></div>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php print_r(session()->get("position_administrator"));?>asdf
			<div class="row">
				<?php
				$from = date("Y-m-01");
				$to = date("Y-m-t");
				$builder = $this->db
					->table("transaction");
				$builder->where("transaction.transaction_date >=", $from);
				$builder->where("transaction.transaction_date <=", $to);
				$builder->where("transaction.transaction_status", "2");//Pending
				$builder->where("transaction.store_id", session()->store_id);
				$pending = $builder
					->get()->getNumRows();
				// echo $this->db->getLastquery();
				?>
				<div class="col-lg-4">
					<div class="card">
						<div class="card-title">
							<h4>Transaksi Pending Bulan Ini</h4>
						</div>
						<div class="todo-list">
							<div class="tdl-holder">
								<div class="tdl-content">
									<ul>
										<li class="color-primary">
											<label>
												<i class="bg-primary"></i><span><?= $pending; ?></span>
											</label>
										</li>
										<li class="color-warning">
											<label>
												<i class="bg-warning"></i><span></span>
											</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				$from = date("Y-m-01");
				$to = date("Y-m-t");
				$builder = $this->db
					->table("transaction");
				$builder->where("transaction.transaction_date >=", $from);
				$builder->where("transaction.transaction_date <=", $to);
				$builder->where("transaction.transaction_status", "0");//Sukses
				$builder->where("transaction.store_id", session()->store_id);
				$sukses = $builder
					->get()->getNumRows();
				// echo $this->db->getLastquery();
				?>
				<div class="col-lg-4">
					<div class="card">
						<div class="card-title">
							<h4>Transaksi Sukses Bulan Ini</h4>
						</div>
						<div class="todo-list">
							<div class="tdl-holder">
								<div class="tdl-content">
									<ul>
										<li class="color-primary">
											<label>
												<i class="bg-primary"></i><span><?= $sukses; ?></span>
											</label>
										</li>
										<li class="color-warning">
											<label>
												<i class="bg-warning"></i><span></span>
											</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>	
				<?php
				$from = date("Y-m-01");
				$to = date("Y-m-t");
				$builder = $this->db
					->table("transaction");
				$builder->where("transaction.transaction_date >=", $from);
				$builder->where("transaction.transaction_date <=", $to);
				$builder->where("transaction.transaction_status", "1");//Batal
				$builder->where("transaction.store_id", session()->store_id);
				$batal = $builder
					->get()->getNumRows();
				// echo $this->db->getLastquery();
				?>
				<div class="col-lg-4">
					<div class="card">
						<div class="card-title">
							<h4>Transaksi Batal Bulan Ini</h4>
						</div>
						<div class="todo-list">
							<div class="tdl-holder">
								<div class="tdl-content">
									<ul>
										<li class="color-primary">
											<label>
												<i class="bg-primary"></i><span><?= $batal; ?></span>
											</label>
										</li>
										<li class="color-warning">
											<label>
												<i class="bg-warning"></i><span></span>
											</label>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>
</div>

<?php echo  $this->include("template/footer_v"); ?>

<?php //echo $this->endSection(); 
?>