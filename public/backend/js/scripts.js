/*!
 * Start Bootstrap - SB Admin v7.0.5 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2022 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
//
// Scripts
//

window.addEventListener("DOMContentLoaded", (event) => {
    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector("#sidebarToggle");
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener("click", (event) => {
            event.preventDefault();
            document.body.classList.toggle("sb-sidenav-toggled");
            localStorage.setItem(
                "sb|sidebar-toggle",
                document.body.classList.contains("sb-sidenav-toggled")
            );
        });
    }

    const tableList = document.querySelector("#datatable");
    const deleteForm = document.querySelector(".delete-form");

    if (tableList) {
        tableList.addEventListener("click", (e) => {
            if (e.target.classList.contains("delete-action")) {
                e.preventDefault();
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        const action = e.target.href;
                        deleteForm.action = action;
                        deleteForm.submit();
                    }
                });
            }
        });
    }
    const getSlug = (title) => {
        //chuyển chữ hòa thành chữ thường
        let slug = title.toLowerCase();

        //xóa khoảng trắng 2 đầu
        slug = slug.trim();

        //chuyển có dấu thành không dấu
        slug = slug.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
        slug = slug.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
        slug = slug.replace(/ì|í|ị|ỉ|ĩ/g, "i");
        slug = slug.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
        slug = slug.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
        slug = slug.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
        slug = slug.replace(/đ/g, "d");
        // slug = slug.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
        // slug = slug.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
        // slug = slug.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
        // slug = slug.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
        // slug = slug.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
        // slug = slug.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
        // slug = slug.replace(/Đ/g, "D");

        // Một vài bộ encode coi các dấu mũ, dấu chữ như một kí tự riêng biệt nên thêm hai dòng này
        slug = slug.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // ̀ ́ ̃ ̉ ̣  huyền, sắc, ngã, hỏi, nặng
        slug = slug.replace(/\u02C6|\u0306|\u031B/g, "");

        // Bỏ dấu câu, kí tự đặc biệt
        slug = slug.replace(
            /!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g,
            ""
        );

        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");

        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tư gạch ngang.
        slug = slug.replace(/\-\-\-\-\-/g, "-");
        slug = slug.replace(/\-\-\-\-/g, "-");
        slug = slug.replace(/\-\-\-/g, "-");
        slug = slug.replace(/\-\-/g, "-");

        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = "@" + slug + "@";
        slug = slug.replace(/\@\-|\-\@|\@/gi, "");

        return slug;
    };

    const title = document.querySelector(".title");
    const slug = document.querySelector(".slug");
    let isChangeSlug = false;

    if (title) {
        if (slug.value === "") {
            title.addEventListener("keyup", function (e) {
                if (!isChangeSlug) {
                    const titleValue = e.target.value;
                    slug.value = getSlug(titleValue);
                }
            });
        }
    }

    if (slug) {
        slug.addEventListener("change", function () {
            if (slug.value === "") {
                const title = document.querySelector(".title");
                const titleValue = title.value;
                slug.value = getSlug(titleValue);
            }
            isChangeSlug = true;
        });
    }

});
