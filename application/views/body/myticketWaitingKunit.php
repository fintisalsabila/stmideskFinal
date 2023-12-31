<div class="row">
    <ol class="breadcrumb">
        <li><a href="#"><svg class="glyph stroked home">
                    <use xlink:href="#stroked-home"></use>
                </svg></a></li>
        <li class="active">My Ticket</li>
    </ol>
</div><!--/.row-->

<br>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"><svg class="glyph stroked bag">
                    <use xlink:href="#stroked-bag" />
                </svg>
                <a href="#" style="text-decoration:none">List Tiket</a> <br><br>

            </div>
            <div class="panel-body"></div>
            <div class="panel-body">
                <table data-toggle="table" data-show-refresh="false" data-show-toggle="true" data-show-columns="true" data-search="true" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                    <thead>
                        <tr>
                            <th data-field="no" data-sortable="true" width="10px"> No</th>
                            <th data-field="idd" data-sortable="true">Id Ticket</th>
                            <th data-field="iddd" data-sortable="true">Tanggal Ticket</th>
                            <th data-field="idddd" data-sortable="true">Nama Kategori</th>
                            <th data-field="iddddd" data-sortable="true">Nama Sub Kategori</th>
                            <th data-field="idxddddd" data-sortable="true">Progress</th>
                            <th data-field="idddddd" data-sortable="true">Status</th>
                            <th data-field="iddfdddd" data-sortable="true">Feedback</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($datamyticket as $row) :
                            // Tambahkan kondisi untuk memfilter hanya baris dengan Feedback positif
                            if ($row->status == 1) : ?>
                                <tr>
                                    <td data-field="no" width="10px"><?php echo $no + 1; ?></td>
                                    <td data-field="id"><a href="<?php echo base_url(); ?>myticket/myticket_detail/<?php echo $row->id_ticket; ?>"><?php echo $row->id_ticket; ?></a></td>
                                    <td data-field="id"><?php echo $row->tanggal; ?></td>
                                    <td data-field="id"><?php echo $row->nama_kategori; ?></td>
                                    <td data-field="id"><?php echo $row->nama_sub_kategori; ?></td>
                                    <td data-field="idxddddd">
                                        <?php
                                        // Ubah nilai angka menjadi teks sesuai dengan kondisi yang diinginkan
                                        if ($row->progress == 0) {
                                            echo 'Pending';
                                        } elseif ($row->progress == 50) {
                                            echo 'On Progress';
                                        } elseif ($row->progress == 100) {
                                            echo 'Done';
                                        } else {
                                            echo $row->progress; // Tampilkan nilai aslinya jika tidak sesuai kondisi di atas
                                        }
                                        ?>
                                    </td>
                                    <td data-field="idddddd">
                                        <?php
                                        if ($row->status == 1) {
                                            echo "MENUNGGU DISETUJUI KEPALA UNIT";
                                        } elseif ($row->status == 2) {
                                            echo "DISETUJUI KEPALA UNIT";
                                        } elseif ($row->status == 0) {
                                            echo "TICKET DITOLAK";
                                        } elseif ($row->status == 3) {
                                            echo "MENUNGGU APRROVAL KASUBAG";
                                        } elseif ($row->status == 4) {
                                            echo "SEDANG MENENTUKAN TEKNISI";
                                        } elseif ($row->status == 5) {
                                            echo "DIKERJAKAN TEKNISI";
                                        } elseif ($row->status == 6) {
                                            echo "SOLVED";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        // Tambahkan kode untuk menampilkan Feedback
                                        if ($row->status == 6 and $row->feedback == "") { ?>
                                            <a class="ubah btn btn-success btn-xs" href="<?php echo base_url(); ?>myticket/feedback_yes/<?php echo $row->id_ticket; ?>/<?php echo $row->id_teknisi; ?>"><span class="glyphicon glyphicon-thumbs-up"></span></a>
                                            <a title="Hapus Kontak" class="hapus btn btn-danger btn-xs" href="<?php echo base_url(); ?>myticket/feedback_no/<?php echo $row->id_ticket; ?>/<?php echo $row->id_teknisi; ?>"><span class="glyphicon glyphicon-thumbs-down"></span></a>
                                        <?php } else if ($row->status == 6 and $row->feedback == 1) {
                                            echo "ANDA MEMBERIKAN FEEDBACK POSITIF";
                                        } else if ($row->status == 6 and $row->feedback == 0) {
                                            echo "ANDA MEMBERIKAN FEEDBACK NEGATIF";
                                        } else if ($row->status == 2) {
                                            echo "MENUNGGU PERSETUJUAN KASUBAG";
                                        } else if ($row->status == 3) {
                                            echo "SEDANG DIPROSES TEKNISI";
                                        } else if ($row->status == 4) {
                                            echo "SEDANG DIKERJAKAN TEKNISI";
                                        } else if ($row->status == 5) {
                                            echo "SEDANG DIKERJAKAN TEKNISI";
                                        } else if ($row->status == 1) {
                                            echo "SEDANG DIAJUKAN KEPADA KEPALA UNIT SETEMPAT";
                                        } else {
                                            echo "TICKET DITOLAK";
                                        }


                                        ?>
                                    </td>
                                </tr>
                        <?php $no++;
                            endif;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><!--/.row-->

<div class="alert bg-warning" role="alert">
    <svg class="glyph stroked flag">
        <use xlink:href="#stroked-flag"></use>
    </svg> Berikanlah Feeedback Sesuai Kinerja Teknisi <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
</div>

<?php echo $this->session->flashdata("msg"); ?>


<script>
    $(function() {
        $('#hover, #striped, #condensed').click(function() {
            var classes = 'table';

            if ($('#hover').prop('checked')) {
                classes += ' table-hover';
            }
            if ($('#condensed').prop('checked')) {
                classes += ' table-condensed';
            }
            $('#table-style').bootstrapTable('destroy')
                .bootstrapTable({
                    classes: classes,
                    striped: $('#striped').prop('checked')
                });
        });
    });

    function rowStyle(row, index) {
        var classes = ['active', 'success', 'info', 'warning', 'danger'];

        if (index % 2 === 0 && index / 2 < classes.length) {
            return {
                classes: classes[index / 2]
            };
        }
        return {};
    }
</script>

<?php $this->load->view('konfirmasi'); ?>

<script type="text/javascript">
    $(document).ready(function() {

        $(".hapus").click(function() {
            var id = $(this).data('id');

            $(".modal-body #mod").text(id);

        });

    });
</script>