<!-- Footer -->
<footer class="sticky-footer bg-dark3">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">yakin ingin keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Logout" jika ingin keluar.</div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-success" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/jquery-3.4.1.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
<!-- Page table -->
<script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Tabel count resposive -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<!-- <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script> -->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.data.Tables.min.js"></script>
<!-- <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery-3.5.1.js"></script> -->

<script src="<?= base_url('assets/js/sweetalert2.all.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/kustom.js'); ?>"></script>
<script src="<?= base_url('assets/js/bootstrap-datepicker.js'); ?>"></script>
<script src="<?= base_url('assets/js/sf.js'); ?>"></script>

<!-- Export CSV -->
<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
<!-- <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>-->
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>


<script>
    let jual;
    let jumlah;
    let totalHarga; // deklarasi di sini
    $("#tabel-data-barang tbody").on("click", "#pilih", function() {
        let nama = $(this).attr("nama");
        let kategori = $(this).attr("kategori");
        let id = $(this).attr("data-id");
        jumlah = $(this).attr("jumlah");
        jual = $(this).attr("jual");

        $("#namaBarang").val(nama);
        $("#kategoriBarang").val(kategori);
        $("#hargaJual").val(jual);
        $("#jumlah_barang").val(jumlah);
        $("#id").val(id);

    });

    $('input[name=qty]').change(function() {
        let qty = $(this).val();
        totalHarga = qty * jual;
        const jumlahDiKurangin = jumlah - qty;

        $("#totalHarga").val(totalHarga);
        $("#jumlah_barang").val(jumlahDiKurangin);

        if (qty > jumlah) {
            //$("#jumlah_barang").val("Stok habis");
            $("#buatTransaksi").prop('disabled', true);
        } else {
            $("#buatTransaksi").prop('disabled', false);
        }

        // sisanya sama aja kek php biasanya
    });
    $('input[name=ttluang]').change(function() {
        let ttluang = $(this).val();
        const uangDikurangi = ttluang - totalHarga;

        $("#uangKembali").html("Rp. " + uangDikurangi + ",-");
        if (ttluang < totalHarga) {
            $("#uangKembali").html("Uang kurang");
            $("#buatTransaksi").prop('disabled', true);
        } else {
            $("#buatTransaksi").prop('disabled', false);
        }
    });
</script>

<script>
    $(document).on('click', '#btn-edit', function() {
        let id = $(this).data('id');
        let ktbarang = $(this).data('kategoribarang');
        // let icon = $(this).data('icon');
        // let deskripsi = $(this).data('deskripsi');
        $('.modal-body #id').val(id);
        $('.modal-body #kategoribarang').val(ktbarang);
        // $('.modal-body #icon').val(icon);
        // $('.modal-body #deskripsi').val(deskripsi);
    });
</script>

<script>
    $(document).on('click', '#btn-useredit', function() {
        let id = $(this).data('id');
        let rid = $(this).data('roleid');
        let isc = $(this).data('isactive');
        $('.modal-body #id').val(id);
        $('.modal-body #roleid').val(rid);
        $('.modal-body #isactive').val(isc);
    });
</script>

<script>
    $(document).on('click', '#ubahMenu', function() {
        let id = $(this).data('id');
        let nmMenu = $(this).data('nmmenu');
        $('.modal-body #id').val(id);
        $('.modal-body #menu').val(nmMenu);
    });
</script>
<script>
    $(document).on('click', '#btn-brgedit', function() {
        let id = $(this).data('id');
        let namabrg = $(this).data('namabrg');
        let brgid = $(this).data('brgid');
        let jmlbrg = $(this).data('jmlbrg');
        let hbeli = $(this).data('hbeli');
        let hjual = $(this).data('hjual');
        $('.modal-body #id').val(id);
        $('.modal-body #nama_barang').val(namabrg);
        $('.modal-body #kd_barang').val(brgid);
        $('.modal-body #jml').val(jmlbrg);
        $('.modal-body #hbeli').val(hbeli);
        $('.modal-body #hjual').val(hjual);
    });
</script>
<script>
    $(document).on('click', '#btn-transaksi', function() {
        let id = $(this).data('id');
        let namabrg = $(this).data('namabrg');
        let brgid = $(this).data('brgid');
        let jmlbrg = $(this).data('jmlbrg');
        /*let hbeli = $(this).data('hbeli');*/
        let hjual = $(this).data('hjual');
        $('.card-body #id').val(id);
        $('.card-body #nama_barang').val(namabrg);
        $('.card-body #kd_barang').val(brgid);
        $('.card-body #jumlah_barang').val(jmlbrg);
        /*$('.card-body #hbeli').val(hbeli);*/
        $('.card-body #hjual').val(hjual);
    });
</script>
<script>
    $(document).on('click', '#btn-tmbstkbrg', function() {
        let id = $(this).data('id');
        let namabrg = $(this).data('namabrg');
        let brgid = $(this).data('brgid');
        let jmlbrg = $(this).data('jmlbrg');
        $('.modal-body #id').val(id);
        $('.modal-body #namabarang').html(': ' + namabrg);
        $('.modal-body #kategori').html(': ' + brgid);
        $('.modal-body #jmlbarang').html(': ' + jmlbrg);
    });
</script>
<script>
    $(document).ready(function() {
        $('#tabel-data-kategori').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('#tabel-data-barang').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('#tabel-data-pengguna').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('#tabel-detailbeli').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('#tabel-barang-keluar').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('#tabel-data-penjualan').DataTable({
            // totalnya gak keprint raf
            // dom: '1Bfrtip',
            // buttons: [
            //     'copy',
            //     {
            //         extend: 'excel',
            //         messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.',
            //         footer: true
            //     },
            //     {
            //         extend: 'pdf',
            //         messageBottom: null,
            //         footer: true
            //         // ya sisanya benerin gih
            //     },
            //     {
            //         // lah gak kena collpan
            //         // cara satuinya gimana raf? satuin apa?, marger pas diprint? iya
            //         // bukannya udh jadi satu?
            //         // emang itu udh jadi satu, itu garis? itu mah cuma warna bjir
            //         // itu? lu harus edit cssnya
            //         // gw kira harus di edit di <th>nya dih terdiam yasudah saia dc sadja oke ty
            //         extend: 'print',
            //         footer: true,
            //         messageBottom: null
            //     }
            // ],
            dom: 'lBfrtip',
            buttons: [{
                extend: 'excel',
                className: 'btn-success',
                title: 'Barang keluar',
                footer: true
            }, {
                extend: 'pdf',
                className: 'btn-info',
                title: 'Barang keluar',
                footer: true
            }, {
                extend: 'print',
                className: 'btn-warning',
                title: 'Barang keluar',
                footer: true
            }],
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };

                // Total over all pages
                total = api
                    .column(6)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotal = api
                    .column(6, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(6).footer()).html(
                    new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(pageTotal) + ',-'
                    //' ( $'+ total +' total)'
                );
            }
        });
    });
</script>
<script></script>

<script>
    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');
        $.ajax({
            url: "<?= base_url('admin/changeaccess'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
            }
        });
    });
</script>

<script>
    $(document).on('click', '#btn-brginfo', function() {
        let id = $(this).data('id');
        let namabrg = $(this).data('namabrg');
        let brgid = $(this).data('brgid');
        let jmlbrg = $(this).data('jmlbrg');
        let hrgbeli = $(this).data('hbeli');
        let hrgjual = $(this).data('hjual');
        let ttlhrgbeli = $(this).data('ttlhbeli');
        $('.modal-body #id').val(id);
        $('.modal-body #namabarang').html(': ' + namabrg);
        $('.modal-body #kategori').html(': ' + brgid);
        $('.modal-body #jmlbarang').html(': ' + jmlbrg);
        $('.modal-body #hbeli').html(': ' + new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(hrgbeli));
        $('.modal-body #hjual').html(': ' + new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(hrgjual));
        $('.modal-body #ttlhbeli').html(': ' + new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(ttlhrgbeli));
    });
</script>

<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>

<!-- table dinamis -->
<script>
    $(document).ready(function() {
        $("#add_row").on("click", function() {
            // Dynamic Rows Code

            // Get max row id and set new id
            var newid = 0;
            $.each($("#tab_logic tr"), function() {
                if (parseInt($(this).data("id")) > newid) {
                    newid = parseInt($(this).data("id"));
                }
            });
            newid++;

            var tr = $("<tr></tr>", {
                id: "addr" + newid,
                "data-id": newid
            });

            // loop through each td and create new elements with name of newid
            $.each($("#tab_logic tbody tr:nth(0) td"), function() {
                var td;
                var cur_td = $(this);

                var children = cur_td.children();

                // add new td and element if it has a nane
                if ($(this).data("name") !== undefined) {
                    td = $("<td></td>", {
                        "data-name": $(cur_td).data("name")
                    });

                    var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                    c.attr("name", $(cur_td).data("name") + newid);
                    c.appendTo($(td));
                    td.appendTo($(tr));
                } else {
                    td = $("<td></td>", {
                        'text': $('#tab_logic tr').length
                    }).appendTo($(tr));
                }
            });

            // add delete button and td
            /*
            $("<td></td>").append(
                $("<button class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>")
                    .click(function() {
                        $(this).closest("tr").remove();
                    })
            ).appendTo($(tr));
            */

            // add the new row
            $(tr).appendTo($('#tab_logic'));

            $(tr).find("td button.row-remove").on("click", function() {
                $(this).closest("tr").remove();
            });
        });




        // Sortable Code
        var fixHelperModified = function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();

            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width())
            });

            return $helper;
        };

        $(".table-sortable tbody").sortable({
            helper: fixHelperModified
        }).disableSelection();

        $(".table-sortable thead").disableSelection();



        $("#add_row").trigger("click");
    });
</script>
<script>
    $(document).ready(function() {
        $("#load").fadeOut(500);
    });
</script>
</body>

</html>