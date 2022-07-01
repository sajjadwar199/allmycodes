<?php
 /* 
 *  js auto genarate by sk_ci3_crud_generator
 *    create crud with modalBootstrap and ajax
 * @package skLibiraris
 * @author sajjadkareem 
 * @category modalAjaxCrud
 * 
 * 
 *
*/
?>
<script>
	/* for  submit insert form   */
	function insertForm_submit(form_insert_id = "insertform") {
		$("#" + form_insert_id).submit();
	}
	/* for  submit update form   */
	function updateForm_submit(form_update_id = "updateform") {
		$("#" + form_insert_id).submit();
	}
	/* for showing data   */
	function serverSide_datatable(url, table_id, Buttons = [
		'excel', 'print',
	], moreOptions = null) {
		$(document).ready(function () {
			$('#datatable_crud thead tr')
				.clone(true)
				.addClass('filters')
				.appendTo('#datatable_crud thead');
			$("#" + table_id).DataTable({
				retrieve: true,
				"processing": !0,
				moreOptions,
				"ajax": {
					url: url,
					type: 'GET',
				},
				dom: 'Blfrtip',
			 
				initComplete: function () {
					var api = this.api();
					// For each column
					api
						.columns()
						.eq(0)
						.each(function (colIdx) {
							// Set the header cell to contain the input element
							var cell = $('.filters th').eq(
								$(api.column(colIdx).header()).index()
							);
							var title = $(cell).text();
							$(cell).html('<input type="text" placeholder="' + title + '" />');
							// On every keypress in this input
							$(
									'input',
									$('.filters th').eq($(api.column(colIdx).header()).index())
								)
								.off('keyup change')
								.on('change', function (e) {
									// Get the search value
									$(this).attr('title', $(this).val());
									var regexr =
										'({search})'; //$(this).parents('th').find('select').val();
									var cursorPosition = this.selectionStart;
									// Search the column for that value
									api
										.column(colIdx)
										.search(
											this.value != '' ?
											regexr.replace('{search}', '(((' + this.value +
												')))') :
											'',
											this.value != '',
											this.value == ''
										)
										.draw();
								})
								.on('keyup', function (e) {
									e.stopPropagation();
									$(this).trigger('change');
									$(this)
										.focus()[0]
										.setSelectionRange(cursorPosition, cursorPosition);
								});
						});
				},
				buttons: Buttons,
				"language": {
					"sProcessing": "جارٍ التحميل...",
					"sLengthMenu": "أظهر _MENU_ مدخلات",
					"sZeroRecords": "لم يعثر على أية سجلات",
					"sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
					"sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
					"sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
					"sInfoPostFix": "",
					"sSearch": "ابحث:",
					"sUrl": "",
					"oPaginate": {
						"sFirst": "الأول",
						"sPrevious": "السابق",
						"sNext": "التالي",
						"sLast": "الأخير"
					},
					"buttons": {
						"print": "طباعة",
						"copyKeys": "زر <i>ctrl<\/i> أو <i>⌘<\/i> + <i>C<\/i> من الجدول<br>ليتم نسخها إلى الحافظة<br><br>للإلغاء اضغط على الرسالة أو اضغط على زر الخروج.",
						"copySuccess": {
							"_": "%d قيمة نسخت",
							"1": "1 قيمة نسخت"
						},
						"pageLength": {
							"-1": "اظهار الكل",
							"_": "إظهار %d أسطر"
						},
						"collection": "مجموعة",
						"copy": "نسخ",
						"copyTitle": "نسخ إلى الحافظة",
						"csv": "CSV",
						"excel": "اكسل",
						"pdf": "PDF",
						"colvis": "إظهار الأعمدة",
						"colvisRestore": "إستعادة العرض"
					},
				}
			}, )
		});
	}
	//for insert data
	function insertData(modal_id, insert_url, btn_add_id, showdata_url, table_id, messages = {
		success: 'تم اضافة   بنجاح  ',
		error: "!هناك خطأ لم تتم الأضافة"
	}) {
		$(document).ready(function () {
			// $('#' + btn_add_id).on('click', function() {
			$('#insertform').on('submit', (function (e) {
				e.preventDefault();
				var formData = new FormData(this);
				//validation
				// if ($.trim(name).length  >=1) {
				$("#" + btn_add_id).attr("disabled", "disabled");
				var form = $('#insertfrm');
				// console.log(form.serialize());
				$.ajax({
					url: insert_url,
					type: "POST",
					data: formData,
					cache: false,
					contentType: false,
					processData: false,
					success: function (dataResult) {
						// if (dataResult.success != false) {
						// 	alert
						// 		(messages.success);
						// } 
						Command: toastr["success"](messages.success)
						toastr.options = {
							"closeButton": true,
							"debug": false,
							"newestOnTop": true,
							"progressBar": true,
							"positionClass": "toast-top-right",
							"preventDuplicates": false,
							"onclick": null,
							"showDuration": "300",
							"hideDuration": "1000",
							"timeOut": "5000",
							"extendedTimeOut": "1000",
							"showEasing": "swing",
							"hideEasing": "linear",
							"showMethod": "fadeIn",
							"hideMethod": "fadeOut"
						}
						$('#' + table_id).DataTable().ajax.reload();
						// serverSide_datatable(showdata_url, table_id);
						$('#insertform')[0].reset();
						$("#" + btn_add_id).removeAttr("disabled");
						var dataResult = JSON.parse(dataResult);
					},
					error: function (dataResult) {
						Command: toastr["warning"](dataResult.responseText)
						toastr.options = {
							"closeButton": true,
							"debug": false,
							"newestOnTop": true,
							"progressBar": true,
							"positionClass": "toast-top-right",
							"preventDuplicates": false,
							"onclick": null,
							"showDuration": "300",
							"hideDuration": "1000",
							"timeOut": "5000",
							"extendedTimeOut": "1000",
							"showEasing": "swing",
							"hideEasing": "linear",
							"showMethod": "fadeIn",
							"hideMethod": "fadeOut"
						}
						$("#" + btn_add_id).removeAttr("disabled");
					}
				});
				// }
				//     else {
				//         alert('Please fill all the field !');
				//  }
			}));
		});
	}
	/* for update data  */
	function updateData(edit_modal_id, insert_url, edit_add_id, showdata_url, table_id, messages = {
		success: 'تم تعديل   بنجاح ',
		error: "هناك خطأ لم يتم التعديل !"
	}) {
		// $('#' + edit_add_id).on('click', function() {
		// if (categoryName != "") {
		$('#updateform').on('submit', (function (e) {
			e.preventDefault();
			var formData = new FormData(this);
			$("#" + edit_add_id).attr("disabled", "disabled");
			$.ajax({
				url: insert_url,
				type: "POST",
				data: $("#updateform").serialize(),
				// {
				// 	id: $('#' + edit_add_id).val()
				// },
				cache: false,
				success: function (dataResult) {
					Command: toastr["success"](messages.success)
					toastr.options = {
						"closeButton": true,
						"debug": false,
						"newestOnTop": true,
						"progressBar": true,
						"positionClass": "toast-top-right",
						"preventDuplicates": false,
						"onclick": null,
						"showDuration": "300",
						"hideDuration": "1000",
						"timeOut": "5000",
						"extendedTimeOut": "1000",
						"showEasing": "swing",
						"hideEasing": "linear",
						"showMethod": "fadeIn",
						"hideMethod": "fadeOut"
					}
					$('#' + table_id).DataTable().ajax.reload();
					// serverSide_datatable(showdata_url, table_id);
					$('#updateform')[0].reset();
					$('#' + edit_modal_id).modal('hide');
					$("#" + edit_add_id).removeAttr("disabled");
					var dataResult = JSON.parse(dataResult);
					if (dataResult.statusCode == 200) {
						$("#" + success_div_id).html(dataResult);
					} else if (dataResult.statusCode == 201) {
						alert
							(messages.error);
					}
				},
				error: function (dataResult) {
					Command: toastr["warning"](dataResult.responseText)
					toastr.options = {
						"closeButton": true,
						"debug": false,
						"newestOnTop": true,
						"progressBar": true,
						"positionClass": "toast-top-right",
						"preventDuplicates": false,
						"onclick": null,
						"showDuration": "300",
						"hideDuration": "1000",
						"timeOut": "5000",
						"extendedTimeOut": "1000",
						"showEasing": "swing",
						"hideEasing": "linear",
						"showMethod": "fadeIn",
						"hideMethod": "fadeOut"
					}
					$("#" + edit_add_id).removeAttr("disabled");
				}
			});
			// }
			//     else {
			//         alert('Please fill all the field !');
			//  }
		}));
	}
	/* FOR delete data */
	function deleteData(delete_url, showdata_url, table_id, messages = {
		success: 'تم الحذف     بنجاح  ',
		error: "هناك خطأ لم يتم الحذف !",
		confirmdelete: "هل أنت متأكد من الحذف"
	}) {
		$(document).on('click', '.delete_btn', function () {
			var id = $(this).attr("id");
			if (confirm(messages.confirmdelete)) {
				$.ajax({
					url: delete_url,
					method: "POST",
					data: {
						id: id
					},
					success: function (data) {
						// alert(messages.success);
						Command: toastr["success"](messages.success)
						toastr.options = {
							"closeButton": true,
							"debug": false,
							"newestOnTop": false,
							"progressBar": false,
							"positionClass": "toast-top-right",
							"preventDuplicates": false,
							"onclick": null,
							"showDuration": "300",
							"hideDuration": "1000",
							"timeOut": "5000",
							"extendedTimeOut": "1000",
							"showEasing": "swing",
							"hideEasing": "linear",
							"showMethod": "fadeIn",
							"hideMethod": "fadeOut"
						}
						$('#' + table_id).DataTable().ajax.reload();
						// serverSide_datatable(showdata_url, table_id);
					},
					error: function (dataResult) {
						Command: toastr["error"](messages.error)
						toastr.options = {
							"closeButton": true,
							"debug": false,
							"newestOnTop": false,
							"progressBar": false,
							"positionClass": "toast-top-right",
							"preventDuplicates": false,
							"onclick": null,
							"showDuration": "300",
							"hideDuration": "1000",
							"timeOut": "5000",
							"extendedTimeOut": "1000",
							"showEasing": "swing",
							"hideEasing": "linear",
							"showMethod": "fadeIn",
							"hideMethod": "fadeOut"
						}
					}
				});
			} else {
				return false;
			}
		});
	}
	/* for edit  */
	function edit(edit_url, modal_id, edit_save_btn_id, set_to_values_edit) {
		$(document).on('click', '.update_btn', function () {
			var id = $(this).attr("id");
			$.ajax({
				url: edit_url,
				method: "POST",
				data: {
					id: id
				},
				dataType: "json",
				cache: false,
				success: function (dataResult) {
					/* setting st art */
					$('#idedit').val(id);
					//to show values in inputs
					set_to_values_edit(dataResult);
					$('#' + modal_id).modal('show');
					//   $('.modal-title').text("Edit User");  
					$('#' + edit_save_btn_id).val(id);
					/* setting end */
				}
			})
		});
	}
</script>
