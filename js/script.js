function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

function openNav() {
    var sidenav = document.getElementById("mySidenav");
    if (window.innerWidth <= 768) {
        sidenav.style.width = "250px";
    }
}

function closeNav() {
    var sidenav = document.getElementById("mySidenav");
    sidenav.style.width = "0";
}

function openN() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeN() {
    document.getElementById("mySidenav").style.width = "0";
}

function signUp() {
    var fn = document.getElementById("fname");
    var ln = document.getElementById("lname");
    var e = document.getElementById("email");
    var pw = document.getElementById("signUpp");
    var m = document.getElementById("mobile");
    var g = document.getElementById("gender");

    var f = new FormData();
    f.append("fname", fn.value);
    f.append("lname", ln.value);
    f.append("email", e.value);
    f.append("password", pw.value);
    f.append("mobile", m.value);
    f.append("gender", g.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });

                Toast.fire({
                    icon: "success",
                    title: "Signed up successfully"
                });

                setTimeout(() => {
                    window.location = "signIn.php";
                }, 1000);

                document.getElementById("msgdiv").className = "d-none";

            } else {
                document.getElementById("msg").innerHTML = t;
                document.getElementById("msg").className = "alert alert-danger";
                document.getElementById("msgdiv").className = "d-block";
            }
        }
    };

    r.open("POST", "signUpProcess.php", true);
    r.send(f);
}

function signin() {
    var email = document.getElementById("email2");
    var password = document.getElementById("signp");
    var rememberme = document.getElementById("rememberme");

    var f = new FormData();
    f.append("e", email.value);
    f.append("p", password.value);
    f.append("r", rememberme.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });

                Toast.fire({
                    icon: "success",
                    title: "Signed in successfully"
                });

                document.getElementById("msgdiv").className = "d-none";

                setTimeout(() => {
                    window.location = "index.php";
                }, 1000);

            } else {
                document.getElementById("msg").innerHTML = t;
                document.getElementById("msg").className = "alert alert-danger";
                document.getElementById("msgdiv").className = "d-block";
            }
        }
    };

    r.open("POST", "signInProcess.php", true);
    r.send(f);
}

var bm;

function forgotPassword() {
    var email = document.getElementById("email2");
    var msgDiv = document.getElementById("msgdiv");
    var msg = document.getElementById("msg");

    msgDiv.classList.add("d-none");
    msg.innerText = "";

    if (!email.value) {
        msg.innerText = "Please enter your email address first";
        msgDiv.classList.remove("d-none");
        return;
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText.trim();

            if (t === "Success") {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Verification code sent!",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    var m = document.getElementById("forgotPasswordModel");
                    bm = new bootstrap.Modal(m);
                    bm.show();
                });
            } else if (t === "Invalid email address" || t === "Please enter your email address first") {
                msg.innerText = t;
                msgDiv.classList.remove("d-none");
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!"
                });
            }
        }
    };

    r.open("GET", "forgotPasswordProcess.php?e=" + encodeURIComponent(email.value), true);
    r.send();
}

function resetPassword() {
    var email = document.getElementById("email2");
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vc = document.getElementById("vc");

    if (!np.value || !rnp.value || !vc.value) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "All fields are required!"
        });
        return;
    }

    if (np.value !== rnp.value) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Passwords do not match!"
        });
        return;
    }

    var f = new FormData();
    f.append("e", email.value);
    f.append("np", np.value);
    f.append("rnp", rnp.value);
    f.append("vc", vc.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText.trim();

            if (t === "Success") {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Your password has been updated.",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    bm.hide();
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: t
                });
            }
        }
    };

    r.open("POST", "resetPasswordProcess.php", true);
    r.send(f);
}

function showPassword1() {

    var np = document.getElementById("np");
    var npb = document.getElementById("npb");

    if (np.type == "password") {
        np.type = "text";
        npb.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    } else {
        np.type = "password";
        npb.innerHTML = '<i class="bi bi-eye"></i>';
    }
}

function showPassword2() {

    var rnp = document.getElementById("rnp");
    var rnpb = document.getElementById("rnpb");

    if (rnp.type == "password") {
        rnp.type = "text";
        rnpb.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    } else {
        rnp.type = "password";
        rnpb.innerHTML = '<i class="bi bi-eye"></i>';
    }
}

function closeModal() {

    bm.hide();
}

function signout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                window.location = "signIn.php";

            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "signoutProcess.php", true);
    r.send();
}

function basicSearch(x) {
    var text = document.getElementById("kw").value;
    var select = document.getElementById("c").value;

    var f = new FormData();
    f.append("t", text);
    f.append("s", select);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("basicSearchResult").innerHTML = t;
        }

    }

    r.open("POST", "basicSearchProcess.php", true);
    r.send(f);
}


function showPassword3() {

    var ps = document.getElementById("signp");
    var nps = document.getElementById("signp2");

    if (ps.type == "password") {
        ps.type = "text";
        nps.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    } else {
        ps.type = "password";
        nps.innerHTML = '<i class="bi bi-eye-fill"></i>';
    }
}

function showPassword4() {

    var ps = document.getElementById("signUpp");
    var nps = document.getElementById("signUpp2");

    if (ps.type == "password") {
        ps.type = "text";
        nps.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    } else {
        ps.type = "password";
        nps.innerHTML = '<i class="bi bi-eye-fill"></i>';
    }
}

function signoutH() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                window.location = "signIn.php";

            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "signoutProcessH.php", true);
    r.send();
}

function advancedSearch(x) {

    var txt = document.getElementById("t");
    var category = document.getElementById("c1");
    var brand = document.getElementById("b1");
    var model = document.getElementById("m");
    var condition = document.getElementById("c2");
    var color = document.getElementById("c3");
    var from = document.getElementById("pf");
    var to = document.getElementById("pt");
    var sort = document.getElementById("sor");

    var f = new FormData();

    f.append("t", txt.value);
    f.append("cat", category.value);
    f.append("b", brand.value);
    f.append("mo", model.value);
    f.append("con", condition.value);
    f.append("col", color.value);
    f.append("pf", from.value);
    f.append("pt", to.value);
    f.append("s", sort.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("view_area").innerHTML = t;
        }
    }

    r.open("POST", "advancedSearchProcess.php", true);
    r.send(f);

}

function clearA() {
    window.location.reload();
}


function changeProfileImg() {
    var img = document.getElementById("profileimage");

    img.onchange = function () {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        document.getElementById("img").src = url;
    }
}

function updateProfile() {
    var profile_img = document.getElementById("profileimage");
    var first_name = document.getElementById("fname");
    var last_name = document.getElementById("lname");
    var mobile_no = document.getElementById("mobile");
    var address_line_1 = document.getElementById("line1");
    var address_line_2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var postal_code = document.getElementById("pcode");

    var f = new FormData();

    if (profile_img.files.length > 0) {
        f.append("img", profile_img.files[0]);
    }

    f.append("fn", first_name.value);
    f.append("ln", last_name.value);
    f.append("mn", mobile_no.value);
    f.append("al1", address_line_1.value);
    f.append("al2", address_line_2.value);
    f.append("p", province.value);
    f.append("d", district.value);
    f.append("c", city.value);
    f.append("pc", postal_code.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            var response = request.responseText.trim().toLowerCase();

            if (response === "success") {
                Swal.fire({
                    title: "Do you want to save the changes?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Save",
                    denyButtonText: `Don't save`
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire("Saved!", "", "success").then(() => {
                            window.location.reload();
                        });
                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                });

            } else if (response === "invalid data") {

                document.getElementById("msg2").innerHTML = "Invalid data";
                document.getElementById("msg2").className = "alert alert-danger";
                document.getElementById("msgDiv2").className = "d-block";

            } else {

                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "You have not filled in the account details correctly. Please check again if the account details are filled in correctly!"
                });

                document.getElementById("msg2").innerHTML = request.responseText;
                document.getElementById("msg2").className = "alert alert-danger";
                document.getElementById("msgDiv2").className = "d-block";
            }
        }
    };

    request.open("POST", "AccountUpdateProcess.php", true);
    request.send(f);
}

function showPassword5() {

    var ps = document.getElementById("pw");
    var nps = document.getElementById("adminsignp2");

    if (ps.type == "password") {
        ps.type = "text";
        nps.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    } else {
        ps.type = "password";
        nps.innerHTML = '<i class="bi bi-eye-fill"></i>';
    }
}

function adminSignIn() {
    var e = document.getElementById("e");
    var pw = document.getElementById("pw");

    var f = new FormData();
    f.append("e", e.value);
    f.append("p", pw.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response == "Success") {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });

                Toast.fire({
                    icon: "success",
                    title: "Admin signed in successfully"
                });

                document.getElementById("msgdiv").className = "d-none";

                setTimeout(() => {
                    window.location = "adminDashboard.php";
                }, 1000);

            } else {
                document.getElementById("msg").innerHTML = response;
                document.getElementById("msg").className = "alert alert-danger";
                document.getElementById("msgdiv").className = "d-block";
            }
        }
    };

    request.open("POST", "adminSignInProcess.php", true);
    request.send(f);
}

function showPassword6() {

    var ps = document.getElementById("ac1");
    var nps = document.getElementById("ac2");

    if (ps.type == "password") {
        ps.type = "text";
        nps.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    } else {
        ps.type = "password";
        nps.innerHTML = '<i class="bi bi-eye-fill"></i>';
    }
}


function closeAlert1() {
    document.getElementById('msgDiv2').classList.add('d-none');
}

function closeAlert2() {
    document.getElementById('msgdiv').classList.add('d-none');
}

function closeAlert3() {
    document.getElementById('msgdiv').classList.add('d-none');
}

function closeAlert4() {
    document.getElementById('msgdiv').classList.add('d-none');
}
function closeAlert5() {
    document.getElementById('msgD1').classList.add('d-none');
}

function closeAlert6() {
    document.getElementById('msgD3').classList.add('d-none');
}

function closeAlert7() {
    document.getElementById('msgD3').classList.add('d-none');
}

function closeAlert8() {
    document.getElementById('msgD4').classList.add('d-none');
}

function closeAlert9() {
    document.getElementById('msgD5').classList.add('d-none');
}

function closeAlert10() {
    document.getElementById('msgD6').classList.add('d-none');
}

function reload() {

    location.reload();
}

function goBack() {
    window.history.back();
}

function addProduct() {
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var title = document.getElementById("title");
    var condition = 0;

    if (document.getElementById("b").checked) {
        condition = 1;
    } else if (document.getElementById("u").checked) {
        condition = 2;
    }

    var clr = document.getElementById("clr");
    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageuploader");

    var form = new FormData();
    form.append("ca", category.value);
    form.append("b", brand.value);
    form.append("m", model.value);
    form.append("t", title.value);
    form.append("con", condition);
    form.append("col", clr.value);
    form.append("q", qty.value);
    form.append("co", cost.value);
    form.append("dwc", dwc.value);
    form.append("doc", doc.value);
    form.append("de", desc.value);

    var file_count = image.files.length;
    for (var x = 0; x < file_count; x++) {
        form.append("image" + x, image.files[x]);
    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText.trim();

            if (response === "Product added successfully!") {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Product added successfully!",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    html: "Product details could not be added correctly.<br><br><b>" + response + "</b>",
                });
            }
        }
    };

    request.open("POST", "addProductProcess.php", true);
    request.send(form);
}


function addProductImage() {
    var image = document.getElementById("imageuploader");

    image.onchange = function () {
        var file_count = image.files.length;
        var allowedTypes = ["image/jpg", "image/jpeg", "image/png", "image/svg+xml"];
        var invalidTypeFound = false;

        for (var i = 0; i < 3; i++) {
            document.getElementById("i" + i).src = "";
        }

        if (file_count > 3) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                html: "<b>" + file_count + " files</b>. You are allowed to upload only 3 or fewer files.",
            });
            image.value = "";
            return;
        }

        for (var x = 0; x < file_count; x++) {
            var file = image.files[x];

            if (!allowedTypes.includes(file.type)) {
                invalidTypeFound = true;
                break;
            }
        }

        if (invalidTypeFound) {
            Swal.fire({
                icon: "error",
                title: "Invalid image type",
                html: "Only JPG, JPEG, PNG, and SVG images are allowed.",
            }).then(() => {
                for (var i = 0; i < 3; i++) {
                    document.getElementById("i" + i).src = "";
                }

                image.value = "";
            });

            return;
        }
        for (var x = 0; x < file_count; x++) {
            var file = image.files[x];
            var url = window.URL.createObjectURL(file);
            document.getElementById("i" + x).src = url;
        }
    };
}

function updateSearch(x) {

    var txt = document.getElementById("us");
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");

    var f = new FormData();

    f.append("t", txt.value);
    f.append("cat", category.value);
    f.append("b", brand.value);
    f.append("mo", model.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("view_area").innerHTML = t;
        }

    }
    r.open("POST", "updateSearchProcess.php", true);
    r.send(f)
}

function sendid(id) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            var response = request.responseText;

            if (response === "success") {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "You can update the product now.",
                    confirmButtonText: "OK",
                    customClass: {
                        confirmButton: "btn btn-success"
                    },
                    buttonsStyling: false
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: response,
                    confirmButtonText: "OK",
                    customClass: {
                        confirmButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                }).then(() => {
                    location.reload();
                });
            }
        }
    };

    request.open("GET", "sendIdProcess.php?id=" + id, true);
    request.send();
}

function changeProductImage() {
    var image = document.getElementById("imageuploader");

    image.onchange = function () {
        var file_count = image.files.length;
        var allowedTypes = ["image/jpg", "image/jpeg", "image/png", "image/svg+xml"];

        if (file_count > 3) {
            Swal.fire({
                icon: "error",
                title: "Too many files",
                html: "<b>" + file_count + " files</b>. You are allowed to upload only 3 or fewer files.",
            });
            image.value = "";
            return;
        }

        for (var i = 0; i < file_count; i++) {
            if (!allowedTypes.includes(image.files[i].type)) {
                Swal.fire({
                    icon: "error",
                    title: "Invalid file type",
                    text: "Only JPG, JPEG, PNG, and SVG allowed."
                });
                image.value = "";
                return;
            }
        }

        for (var i = 0; i < 3; i++) {
            document.getElementById("i" + i).src = "";
        }

        for (var x = 0; x < file_count; x++) {
            var url = window.URL.createObjectURL(image.files[x]);
            document.getElementById("i" + x).src = url;
        }
    };
}

function updateProduct() {
    var title = document.getElementById("t");
    var qty = document.getElementById("q");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var description = document.getElementById("d");
    var images = document.getElementById("imageuploader");

    var form = new FormData();
    form.append("t", title.value.trim());
    form.append("q", qty.value.trim());
    form.append("dwc", dwc.value.trim());
    form.append("doc", doc.value.trim());
    form.append("d", description.value.trim());

    var file_count = images.files.length;
    var allowedTypes = ["image/jpg", "image/jpeg", "image/png", "image/svg+xml"];

    if (file_count > 3) {
        Swal.fire({
            icon: "error",
            title: "Too many images",
            text: "You can only upload up to 3 images."
        });
        return;
    }

    for (var i = 0; i < file_count; i++) {
        if (!allowedTypes.includes(images.files[i].type)) {
            Swal.fire({
                icon: "error",
                title: "Invalid image type",
                text: "Only JPG, JPEG, PNG, and SVG files are allowed."
            });
            return;
        }
    }

    for (var x = 0; x < file_count; x++) {
        form.append("i" + x, images.files[x]);
    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            var response = request.responseText.trim();

            if (response.includes("Product has been Updated")) {
                Swal.fire({
                    icon: "success",
                    title: "Product Updated!",
                    text: "Your product has been updated successfully!",
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Update Failed",
                    html: "<b>" + response + "</b>"
                });
            }
        }
    };

    request.open("POST", "updateProductProcess.php", true);
    request.send(form);
}

function manageSearch(x) {

    var txt = document.getElementById("ms");
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");

    var f = new FormData();

    f.append("t", txt.value);
    f.append("cat", category.value);
    f.append("b", brand.value);
    f.append("mo", model.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("view_area").innerHTML = t;
        }

    }
    r.open("POST", "manageSearchProcess.php", true);
    r.send(f)
}

function changeStatus(id) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            actions: 'd-flex gap-2 justify-content-center',
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        text: "You are about to change the status of this product.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, change it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            var request = new XMLHttpRequest();

            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var response = request.responseText.trim();

                    if (response === "Product Successfully Activated") {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Product activated successfully",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });

                    } else if (response === "Product Successfully Deactivated") {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Product deactivated successfully",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });

                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: response
                        });
                    }
                }
            };

            request.open("GET", "changeStatusProcess.php?id=" + id, true);
            request.send();

        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelled",
                text: "Product status unchanged.",
                icon: "error"
            });
        }
    });
}

function category() {
    var cat = document.getElementById("cat");

    var f = new FormData();
    f.append("c", cat.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText.trim();

            if (response === "Success") {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Your category has been successfully registered!",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.reload();
                });

                document.getElementById("msgD3").className = "d-none";

            } else {

                document.getElementById("msgB3").innerHTML = response;
                document.getElementById("msgB3").className = "alert alert-danger";
                document.getElementById("msgD3").className = "d-block";
            }
        }
    };

    request.open("POST", "categoryRegisterProcess.php", true);
    request.send(f);
}

function brand() {
    var brand = document.getElementById("b");

    var f = new FormData();
    f.append("b", brand.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText.trim();

            if (response === "Success") {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Your brand has been successfully registered!",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.reload();
                });

                document.getElementById("msgD4").className = "d-none";

            } else {
                document.getElementById("msgB4").innerHTML = response;
                document.getElementById("msgB4").className = "alert alert-danger";
                document.getElementById("msgD4").className = "d-block";
            }
        }
    };

    request.open("POST", "brandRegisterProcess.php", true);
    request.send(f);
}

function model() {
    var model = document.getElementById("m");

    var f = new FormData();
    f.append("m", model.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText.trim();

            if (response === "Success") {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Your model has been successfully registered!",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.reload();
                });

                document.getElementById("msgD5").className = "d-none";

            } else {

                document.getElementById("msgB5").innerHTML = response;
                document.getElementById("msgB5").className = "alert alert-danger";
                document.getElementById("msgD5").className = "d-block";
            }
        }
    };

    request.open("POST", "modelRegisterProcess.php", true);
    request.send(f);
}

function color() {
    var color = document.getElementById("c");

    var f = new FormData();
    f.append("c", color.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText.trim();

            if (response === "Success") {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Your color has been successfully registered!",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.reload();
                });

                document.getElementById("msgD6").className = "d-none";

            } else {

                document.getElementById("msgB6").innerHTML = response;
                document.getElementById("msgB6").className = "alert alert-danger";
                document.getElementById("msgD6").className = "d-block";
            }
        }
    };

    request.open("POST", "colorRegisterProcess.php", true);
    request.send(f);
}

function loadUser() {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var response = request.responseText;
            document.getElementById("tb").innerHTML = response;
        }
    };

    request.open("POST", "loadUserProcess.php", true);
    request.send();
}

function userStatus(email) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            actions: 'd-flex gap-2 justify-content-center',
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        text: "You are about to change the status of this user.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, change it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            var request = new XMLHttpRequest();

            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var response = request.responseText.trim();

                    if (response === "User Successfully Activated") {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "User activated successfully",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });

                    } else if (response === "User Successfully Deactivated") {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "User deactivated successfully",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });

                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: response
                        });
                    }
                }
            };

            request.open("GET", "userStatusProcess.php?email=" + encodeURIComponent(email), true);
            request.send();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelled",
                text: "User status unchanged.",
                icon: "error"
            });
        }
    });
}

function adminLogout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState === 4 && r.status === 200) {
            var t = r.responseText;
            if (t == "success") {

                window.location = 'adminSignIn.php';

            } else {

                alert(t);

            }
        };
    }
    r.open("GET", "adminSignoutProcess.php", true);
    r.send();

}

function customerAdminLogin() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState === 4 && r.status === 200) {
            var t = r.responseText;
            if (t == "success") {

                window.location = 'signIn.php';

            } else {

                alert(t);

            }
        };
    }
    r.open("GET", "adminCustomerLoginProcess.php", true);
    r.send();


}

function imageSaveAdmin() {
    var profile_img = document.getElementById("profileimage");

    var f = new FormData();
    f.append("img", profile_img.files[0]);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response == "success") {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "User Profile Successfully Updated",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.reload();
                });

            } else if (response) {
                document.getElementById("msgB1").innerHTML = response;
                document.getElementById("msgB1").className = "alert alert-danger";
                document.getElementById("msgD1").className = "d-block";
            }
        }
    };

    request.open("POST", "SaveAdminImageProcess.php", true);
    request.send(f);
}

function changeAdminImg() {
    var img = document.getElementById("profileimage");

    img.onchange = function () {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        document.getElementById("img").src = url;
    }
}

function loadMainImg(id) {

    var sample_img = document.getElementById("productImg" + id).src;
    var main_img = document.getElementById("mainImg");

    main_img.src = sample_img;

}


function sendsingelProductid(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {

                window.location.href = "singleProductView.php?id=" + id;
            } else {
                document.getElementById("msgB2").innerHTML = response;
                document.getElementById("msgB2").className = "alert alert-danger";
                document.getElementById("msgD2").className = "d-block";
            }
        }
    }

    request.open("GET", "sendsingleProductIdProcess.php?id=" + id, true);
    request.send();

}

function sendsingelProductid(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {

                window.location.href = "singleProductView.php?id=" + id;
            } else {
                document.getElementById("msgB2").innerHTML = response;
                document.getElementById("msgB2").className = "alert alert-danger";
                document.getElementById("msgD2").className = "d-block";
            }
        }
    }

    request.open("GET", "sendsingleProductIdProcess.php?id=" + id, true);
    request.send();

}


function sendsingelProductid(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {

                window.location.href = "singleProductView.php?id=" + id;
            } else {
                document.getElementById("msgB2").innerHTML = response;
                document.getElementById("msgB2").className = "alert alert-danger";
                document.getElementById("msgD2").className = "d-block";
            }
        }
    }

    request.open("GET", "sendsingleProductIdProcess.php?id=" + id, true);
    request.send();

}

function home() {

    window.location.href = "index.php";

}

function addToCart(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {

        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "New product added to the Cart" || response == "Cart updated") {

                updateCartBadge(response);

            } else {

                console.error("Error: " + response);

            }
            if (response == "Please Login or Signup First") {

                window.location = "signIn.php";
            }
        }
    };

    request.open("GET", "addToCartProcess.php?id=" + id, true);
    request.send();
}

function changeQTY(id) {
    var qty = document.getElementById("qty_num").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "Updated") {
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("GET", "cartQtyUpdateProcess.php?qty=" + qty + "&id=" + id, true);
    request.send();

}

function deleteFromCart(id) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            actions: 'd-flex justify-content-center gap-2',
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, remove it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            var request = new XMLHttpRequest();

            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var response = request.responseText;
                    if (response === "Removed") {
                        swalWithBootstrapButtons.fire({
                            title: "Removed!",
                            text: "Product removed from the cart.",
                            icon: "success"
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        swalWithBootstrapButtons.fire({
                            title: "Error!",
                            text: response,
                            icon: "error"
                        });
                    }
                }
            };

            request.open("GET", "deleteFromCartProcess.php?id=" + id, true);
            request.send();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelled",
                text: "The product is still in your cart :)",
                icon: "error"
            });
        }
    });
}

function cartSearch(x) {

    var txt = document.getElementById("cs");
    var category = document.getElementById("category");

    var f = new FormData();

    f.append("t", txt.value);
    f.append("cat", category.value);
    f.append("page", x);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("view_area").innerHTML = t;
        }

    }
    r.open("POST", "cartSearchProcess.php", true);
    r.send(f)

}

function addToCartSearch(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "New product added to the cart." || response == "Cart updated") {
                window.location.reload();
            }
        }
    }

    request.open("GET", "addToCartSearchProcess.php?id=" + id, true);
    request.send();

}

function updateCartBadge(response) {
    var cartBadge = document.getElementById("cart-badge");

    if (response == "New product added to the Cart" || response == "Cart updated") {

        var cartCountRequest = new XMLHttpRequest();
        cartCountRequest.onreadystatechange = function () {
            if (cartCountRequest.readyState == 4 && cartCountRequest.status == 200) {
                cartBadge.textContent = cartCountRequest.responseText;
            }
        };

        cartCountRequest.open("GET", "getCartCount.php", true);
        cartCountRequest.send();
    } else {
        console.error("Error updating cart badge: " + response);
    }
}

function payNow(id) {
    var qty = document.getElementById("qty_input").value;

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response === "1") {
                window.location = "signIn.php";
            } else if (response === "2") {
                window.location = "myAccount.php";
            } else if (response === "Product is out of stock") {
                Swal.fire({
                    title: "Product is out of stock",
                    icon: "error",
                    showClass: {
                        popup: `
                            animate__animated
                            animate__fadeInUp
                            animate__faster
                        `
                    },
                    hideClass: {
                        popup: `
                            animate__animated
                            animate__fadeOutDown
                            animate__faster
                        `
                    }
                });
            } else {
                var obj = JSON.parse(response);
                var mail = obj["umail"];
                var amount = obj["amount"];

                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                    saveInvoice(orderId, id, mail, amount, qty);
                };

                payhere.onDismissed = function onDismissed() {
                    console.log("Payment dismissed");
                };

                payhere.onError = function onError(error) {
                    console.log("Error:" + error);
                };

                var payment = {
                    sandbox: true,
                    merchant_id: obj["mid"],
                    return_url: "http://localhost/xflax/singleProductView.php?id=" + id,
                    cancel_url: "http://localhost/xflax/singleProductView.php?id=" + id,
                    notify_url: "http://sample.com/notify",
                    order_id: obj["id"],
                    items: obj["item"],
                    amount: amount + ".00",
                    currency: "LKR",
                    hash: obj["hash"],
                    first_name: obj["fname"],
                    last_name: obj["lname"],
                    email: mail,
                    phone: obj["mobile"],
                    address: obj["address"],
                    city: obj["city"],
                    country: "Sri Lanka",
                    delivery_address: obj["address"],
                    delivery_city: obj["city"],
                    delivery_country: "Sri Lanka",
                    custom_1: "",
                    custom_2: ""
                };

                payhere.startPayment(payment);
            }
        }
    };

    request.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
    request.send();
}

function saveInvoice(orderId, id, mail, amount, qty) {

    var form = new FormData();
    form.append("o", orderId);
    form.append("i", id);
    form.append("m", mail);
    form.append("a", amount);
    form.append("q", qty);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "saveInvoiceProcess.php", true);
    request.send(form);


}

function printInvoice() {

    var restorePage = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorePage;

}

function checkValue(input, min, max) {
    let value = parseInt(input.value);
    if (isNaN(value) || value < min) {
        input.value = min;
    } else if (value > max) {
        input.value = max;
    }
}

function loadInvoice() {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var response = request.responseText;
            document.getElementById("tb").innerHTML = response;
        }
    };

    request.open("POST", "loadInvoiceProcess.php", true);
    request.send();

}

function addToWatchlist(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "added") {

                document.getElementById("heart" + id).classList.remove("text-dark");
                document.getElementById("heart" + id).classList.add("text-danger");

            } else if (response == "removed") {
                document.getElementById("heart" + id).classList.remove("text-danger");
                document.getElementById("heart" + id).classList.add("text-dark");

            } else {
                window.location = "signIn.php";
            }

        }
    }

    request.open("GET", "addToWatchlistProcess.php?id=" + id, true);
    request.send();

}

function deleteFromWhishlist(id) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            actions: 'd-flex gap-2 justify-content-center',
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        text: "Do you want to remove this product from your wishlist?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, remove it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {

            var request = new XMLHttpRequest();

            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var response = request.responseText;
                    if (response == "Removed") {
                        swalWithBootstrapButtons.fire({
                            title: "Removed!",
                            text: "Product removed from your wishlist.",
                            icon: "success"
                        }).then(() => {
                            location.reload();
                        });

                    } else {
                        swalWithBootstrapButtons.fire({
                            title: "Error!",
                            text: response,
                            icon: "error"
                        });
                    }
                }
            };

            request.open("GET", "deleteFromWhishlistProcess.php?id=" + id, true);
            request.send();

        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelled",
                text: "Your wishlist item is safe :)",
                icon: "error"
            });
        }
    });
}

function whishlistSearch(x) {

    var txt = document.getElementById("ws");
    var category = document.getElementById("category");

    var f = new FormData();

    f.append("t", txt.value);
    f.append("cat", category.value);
    f.append("page", x);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("view_area").innerHTML = t;


        }

    }
    r.open("POST", "whishlistSearchProcess.php", true);
    r.send(f)

}

function addToWhishlistSearch(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {

        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "added" || "removed") {

                window.location.reload();
            }
        }
    }

    request.open("GET", "addToWhishlistSearchProcess.php?id=" + id, true);
    request.send();
}

function loadUserReport() {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var response = request.responseText;
            document.getElementById("tb").innerHTML = response;
        }
    };

    request.open("POST", "loadUsersReportProcess.php", true);
    request.send();


}

function printProRep() {

    var originalContent = document.body.innerHTML;
    var printArea = document.getElementById("printA").innerHTML;
    document.body.innerHTML = printArea;
    window.print();
    document.body.innerHTML = originalContent;
}

function userReport() {


    window.location = "usersReport.php";

}

function loadPurchasedHistoryUserReport() {


    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var response = request.responseText;
            document.getElementById("tb").innerHTML = response;
        }
    };

    request.open("POST", "loadPurchasedHistoryUsersReportProcess.php", true);
    request.send();
}

function printPro1Rep() {

    var originalContent = document.body.innerHTML;
    var printArea = document.getElementById("printA").innerHTML;
    document.body.innerHTML = printArea;
    window.print();
    document.body.innerHTML = originalContent;
}

function userReport1() {


    window.location = "purchasedHistoryUsersReport.php";

}

function loadWishlistEngageUserReport() {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var response = request.responseText;
            document.getElementById("tb").innerHTML = response;
        }
    };

    request.open("POST", "loadWishlistEngageUsersReportProcess.php", true);
    request.send();


}

function printPro2Rep() {

    var originalContent = document.body.innerHTML;
    var printArea = document.getElementById("printA").innerHTML;
    document.body.innerHTML = printArea;
    window.print();
    document.body.innerHTML = originalContent;
}

function userReport2() {


    window.location = "wishlistEngageUsersReport.php";

}

function checkOut(email, productIds) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            if (request.status === 200) {
                var response = request.responseText;

                try {
                    var obj = JSON.parse(response);


                    if (obj.status === 1) {

                        window.location = "signIn.php";
                        return;
                    } else if (obj.status === 2) {

                        window.location = "myAccount.php";
                        return;
                    } else if (obj.status === 3) {

                        alert("Your cart is empty.");
                        return;
                    }

                    var mail = obj.umail;
                    var amount = parseFloat(obj.amount);
                    var id = obj.id;
                    var qty = obj.qty || 0;

                    payhere.onCompleted = function onCompleted(orderId) {
                        console.log("Payment completed. OrderID:" + orderId);
                        savecheckoutInvoice(orderId, id, mail, amount, qty);
                    };

                    payhere.onDismissed = function onDismissed() {
                        console.log("Payment dismissed");
                    };

                    payhere.onError = function onError(error) {
                        console.error("Payment error:", error);
                    };

                    var payment = {
                        sandbox: true,
                        merchant_id: obj.mid,
                        return_url: "http://localhost/xflax/cart.php",
                        cancel_url: "http://localhost/xflax/cart.php",
                        notify_url: "http://sample.com/notify",
                        order_id: id,
                        items: obj.item,
                        amount: amount.toFixed(2),
                        currency: "LKR",
                        hash: obj.hash,
                        first_name: obj.fname,
                        last_name: obj.lname,
                        email: mail,
                        phone: obj.mobile,
                        address: obj.address,
                        city: obj.city,
                        country: "Sri Lanka",
                        delivery_address: obj.address,
                        delivery_city: obj.city,
                        delivery_country: "Sri Lanka"
                    };

                    payhere.startPayment(payment);

                } catch (e) {
                    console.error("JSON parsing error:", e);
                    console.log("Raw response:", response);
                    alert("An error occurred while processing payment data.");
                }
            } else {
                console.error("Server error:", request.status, request.statusText);
                alert("Failed to process checkout. Please try again.");
            }
        }
    };

    request.open("POST", "checkoutProcess.php", true);
    request.setRequestHeader("Content-Type", "application/json");
    request.send(JSON.stringify({ email: email, product_ids: productIds }));
}



function savecheckoutInvoice(orderId, id, mail, amount, qty) {
    var form = new FormData();
    form.append("o", orderId);
    form.append("i", id);
    form.append("m", mail);
    form.append("a", amount);
    form.append("q", qty);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            if (request.status === 200) {
                var response = request.responseText.trim();

                if (response === "success") {
                    window.location = "checkoutInvoice.php?id=" + encodeURIComponent(orderId);
                } else {
                    alert("Invoice save error: " + response);
                }
            } else {
                console.error("Invoice save failed:", request.status, request.statusText);
                alert("Failed to save invoice. Please try again.");
            }
        }
    };

    request.open("POST", "saveCheckoutInvoiceProcess.php", true);
    request.send(form);
}


document.getElementById("province").addEventListener("change", function () {
    let pid = this.value;
    fetch("load_districts.php?pid=" + pid)
        .then(res => res.text())
        .then(data => {
            document.getElementById("district").innerHTML = data;
            document.getElementById("city").innerHTML = '<option value="0">Select City</option>';
        });
});

document.getElementById("district").addEventListener("change", function () {
    let did = this.value;
    fetch("load_cities.php?did=" + did)
        .then(res => res.text())
        .then(data => {
            document.getElementById("city").innerHTML = data;
        });
});
