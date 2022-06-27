<div class="app-title">
	<div>
		<h1> <i class="fa fa-certificate" aria-hidden="true"></i>
			أدارة الأصناف</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb side">
		<li class="breadcrumb-item">أدارة الأصناف</li>
		<li class="breadcrumb-item active"><a href="#">تجهيز المواد </a></li>
	</ul>
</div>
<div class="col-md-12 grid-margin stretch-card">
	<div class="card">
		<div class="card-body">
			<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modelId">
				أضافة صنف جديد
				<i class="fa fa-plus-circle" aria-hidden="true"></i>
			</button>
			<br>
			<br>
			<!-- Button trigger modal -->
			<!-- insert  Modal -->
			<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" align="right"> أضافة صنف جديد </h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="col-sm-12">
								<div class="col-md-12">
									<div class="form-group row">


										<div class="col-sm-9">


											<form id="insertform" >


												<input type="text" id="name" name="name" class="form-control" required>
										</div>

										<label class="col-sm-3 col-form-label">أسم الصنف</label>
									</div>
								</div>

							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
							<button type="button" class="btn btn-primary" id="save">حفظ</button>

						</div>
					</div>
				</div>
				</form>
			</div>
			<!-- edit modal  -->
			<div class="modal fade" id="modal-edit-id" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" align="right"> تعديل الصنف</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="col-sm-12">
								<div class="col-md-12">
									<div class="form-group row">
										<div class="col-sm-9">

										<form id="updateform"   >











                                             <!--  very-importent input for edit id   -->
										<input type="text" hidden  id="idedit" value="" name="id" class="form-control">
                                             <!--  very-importent input for edit id   -->

                                
											<input type="text" id="categoryNameedit"  name="name" class="form-control">
										</div>
										<label class="col-sm-3 col-form-label">أسم الصنف</label>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
							<button type="button" class="btn btn-info" id="edit">حفظ</button>
						</div>
					</div>
					
				</div>
				</form>
			</div>
			<div class="  row">
				<div class=" table-responsive ">
					<div class="row">
						<div class="col-sm-12">
							<table id="category" class="table   " id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
								<thead>
									<tr role="row">
										<th>أسم الصنف</th>
										<th>تاريخ الاضافة</th>
										<th>الحالة</th>
										<th>عدد المواد المتوفرة في هذه الصنف </th>
										<th> </th>
										<th> </th>
									</tr>
								</thead>
								<tfoot>
								</tfoot>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	serverSide_datatable("Categories/list", "category");
	insertData("modelId", "Categories/insert", "save", "Categories/list", "category");
	deleteData("Categories/delete", "Categories/list", "category");
	updateData("modal-edit-id", "Categories/update", "edit", "Categories/list", "category");
	edit("Categories/edit", "modal-edit-id", "edit",function(dataResult){

		$('#categoryNameedit').val(dataResult[0].name);

	});
</script>