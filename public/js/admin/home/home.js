let TableLists = $('table#TableLists').DataTable({
    ajax : {
        type : "POST",
        url : url_gb+"/admin/lists"
    },
    columns : [
        {"data" : "DT_RowIndex" , "className": "text-center", "searchable": false, "orderable": false},
        {"data" : "username", visible : false},
        {"data" : "email", visible : false},
        {"data" : "username_or_email", searchable : false},
        {"data" : "permission"},
        {"data" : "actions"},
    ]
});
$('#edit_permission').select2({
    allowClear : true,
    placeholder : 'Select Permission'
})
$('body').on('click', 'button.btn-edit', function(){
    let id = $(this).data('id');
    $.ajax({
        type: "GET",
        url: url_gb+"/admin/show/"+id,
        dataType : 'json',
    }).done(function( rec ) {
        if(rec.statusCode == 200){
            $('#edit_id').val(rec.results.id);
            $('#edit_permission').val(rec.results.permission).change();
            $('#modalEdit').modal('show');
        }else{
            alert('แสดงข้อมูลไม่สำเร็จ ระบบมีปัญหา โปรดติดต่อเจ้าหน้าที่');
        }
    }).fail(function(rec){
        if(rec.status == 404){
            alert('แสดงข้อมูลไม่สำเร็จ '+rec.responseJSON.status);
        }else{
            alert('แสดงข้อมูลไม่สำเร็จ ระบบมีปัญหา โปรดติดต่อเจ้าหน้าที่');
        }
    });
});
$('#FormEdit').validate({
    rules : {
        permission : 'required'
    },
    messages : {
        permission : 'required'
    },
    submitHandler : function(form){
        let formData = $(form).serialize();
        $.ajax({
            type: "PATCH",
            url: url_gb+"/admin/update",
            data: formData,
            dataType : 'json',
        }).done(function( rec ) {
            if(rec.statusCode == 200){
                TableLists.ajax.reload();
                $('#modalEdit').modal('hide');
            }else{
                alert('แก้ไขข้อมูลไม่สำเร็จ ระบบมีปัญหา โปรดติดต่อเจ้าหน้าที่');
            }
        }).fail(function(rec){
            if(rec.status == 400){
                alert('แก้ไขข้อมูลไม่สำเร็จ '+rec.responseJSON.status);
            }else{
                alert('แก้ไขข้อมูลไม่สำเร็จ ระบบมีปัญหา โปรดติดต่อเจ้าหน้าที่');
            }
        });
    }
});

$('body').on('click', 'button.btn-delete', function(){
    let id = $(this).data('id');
    Swal.fire({
        title: 'ยืนยันการลบ',
        showDenyButton: true,
        confirmButtonText: 'ยืนยันการลบ',
        denyButtonText: `ยกเลิกการลบ`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: url_gb+"/admin/delete/"+id,
                dataType : 'json',
            }).done(function( rec ) {
                if(rec.statusCode == 200){
                    TableLists.ajax.reload();
                    Swal('ลบข้อมูลแล้ว', '', 'success');
                }else{
                    alert('ลบข้อมูลไม่สำเร็จ ระบบมีปัญหา โปรดติดต่อเจ้าหน้าที่');
                }
            }).fail(function(rec){
                if(rec.status == 400){
                    alert('ลบข้อมูลไม่สำเร็จ '+rec.responseJSON.status);
                }else{
                    alert('ลบข้อมูลไม่สำเร็จ ระบบมีปัญหา โปรดติดต่อเจ้าหน้าที่');
                }
            });
        }
    })

});
