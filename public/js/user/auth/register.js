$('#register').validate({
    rules : {
        username : 'required',
        password : 'required',
        confirm_password : {
            required : true,
            equalTo : '#password-field'
        },
    },
    messages : {
        username : '*required',
        password : '*required',
        confirm_password : {
            required : '*required',
            equalTo : 'passwords are not the same'
        },
    },
    submitHandler : function(form){
        let formData = $(form).serialize();
        $.ajax({
            type: "POST",
            url: url_gb+"/user/register",
            data: formData,
            dataType : 'json',
        }).done(function( rec ) {
            if(rec.statusCode == 200){
                alert('สมัครสมาชิกสำเร็จ');
                window.location = url_gb+"/user";
                // Swal.fire('สมัครสมาชิกไม่สำเร็จ', 'ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง', 'error');
            }else{
                alert('สมัครสมาชิกไม่สำเร็จ ระบบมีปัญหา โปรดติดต่อเจ้าหน้าที่');
            }
        }).fail(function(rec){
            console.log(rec);
            // Swal.fire('สมัครสมาชิกไม่สำเร็จ', 'ระบบมีปัญหา โปรดติดต่อเจ้าหน้าที่', 'error');
            if(rec.status == 400){
                alert('สมัครสมาชิกไม่สำเร็จ '+rec.responseJSON.status);
            }else{
                alert('สมัครสมาชิกไม่สำเร็จ ระบบมีปัญหา โปรดติดต่อเจ้าหน้าที่');
            }
        });
    }
});
