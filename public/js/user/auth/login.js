$('#login').validate({
    rules : {
        username : 'required',
        password : 'required',
    },
    messages : {
        username : '*required',
        password : '*required',
    },
    submitHandler : function(form){
        let formData = $(form).serialize();
        $.ajax({
            type: "POST",
            url: url_gb+"/user/login",
            data: formData,
            dataType : 'json',
        }).done(function( rec ) {
            if(rec.statusCode == 200){
                window.location = url_gb+"/user";
                // Swal.fire('เข้าสู่ระบบไม่สำเร็จ', 'ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง', 'error');
            }else{
                alert('เข้าสู่ระบบไม่สำเร็จ ระบบมีปัญหา โปรดติดต่อเจ้าหน้าที่');
            }
        }).fail(function(rec){
            console.log(rec);
            // Swal.fire('เข้าสู่ระบบไม่สำเร็จ', 'ระบบมีปัญหา โปรดติดต่อเจ้าหน้าที่', 'error');
            if(rec.status == 400){
                alert('เข้าสู่ระบบไม่สำเร็จ '+rec.responseJSON.status);
            }else{
                alert('เข้าสู่ระบบไม่สำเร็จ ระบบมีปัญหา โปรดติดต่อเจ้าหน้าที่');
            }
        });
    }
});
