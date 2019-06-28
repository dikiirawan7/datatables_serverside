<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">    
    <title>Log</title>
    <link href="<?php echo base_url('assets/css/bootstrap.css')?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/datatables/css/jquery.dataTables.min.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css"/>
</head>
<style>
.table{
    border:1px solid #343a40;
}
.thead-dark{
    background-color:#343a40;
    color:white;
}
.thead-primary{
    background-color:#007bff;
    color:white;
}
.mt-3{
    padding-top:20px;
}
.page{
    background-color: #f1f1f1;
    padding: 0.01em 16px;
    margin: 20px 0;
    box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12) !important;
}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus{
    background-color: #f1f1f1;
}
.center{
    text-align:center;
}
#myTableProduksi
{
    width:895px !important;
    border:1px solid #007bff;
}
</style>
<body>
    
    <div class="container">
        <div class="row page">
        <div class="col-md-10 col-md-offset-1">
            <h2 class="center">LOG LIST ISG</h2>

            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Log Pabean</a></li>
                <li><a data-toggle="tab" href="#menu1">Log Produksi</a></li>
                
            </ul>
            
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active mt-3">
                    <table class="table table-striped table-hover" id="myTable">
                    <thead class="thead-dark">
                        <tr>
                            <th class="col-md-4">Nomor Aju</th>
                            <th class="col-md-4">Keterangan</th>
                            <th class="col-md-4">kondisi</th>
                        </tr>
                    </thead>
                    </table>
                </div>

                <div id="menu1" class="tab-pane fade mt-3">
                    <table class="table table-striped table-hover" id="myTableProduksi">
                        <thead class="thead-primary">
                            <tr>
                                <th class="col-md-4">Nomor Aju</th>
                                <th class="col-md-4">Keterangan</th>
                                <th class="col-md-4">kondisii</th>
                            </tr>
                        </thead>
                    </table>
                </div>

            </div>
        </div>
        </div>
    </div>


    <!--Script js-->
    <script src="<?php echo base_url().'assets/js/jquery.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
    <script src="<?php echo base_url().'assets/datatables/js/jquery.dataTables.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/datatables/js/dataTables.bootstrap.js'?>"></script>

    <script>
        $(document).ready(function(){
            //setup datatables
            $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
            {
                return{
                    "iStart"            :   oSettings._iDisplayStart,
                    "iEnd"              :   oSettings.fnDisplayEnd(),
                    "iLength"           :   oSettings._iDisplayLength,
                    "iTotal"            :   oSettings.fnRecordsTotal(),
                    "iFilteredTotal"    :   oSettings.fnRecordsDisplay(),
                    "iPage"             :   Math.ceil(oSettings._iDisplayStart/oSettings._iDisplayLength),
                    "iTotalPages"       :   Math.ceil(oSettings.fnRecordsDisplay()/oSettings._iDisplayLength)
                };
            };

            var table   =   $("#myTable").dataTable({
                initComplete : function(){
                    var api = this.api();
                    $('#myTable_filter input')
                        .off('.DT')
                        .on('input.DT',function(){
                            api.search(this.value).draw();
                        });
                },
                oLanguage : {
                    sProcessing : "loading...",
                    sSearchPlaceholder: "search by No Aju"
                },
                processing  :   true,
                serverSide  :   true,
                ajax        :   {
                    "url"   :   "<?php echo base_url('index.php/log/get_all')?>",
                    "type"  :   "POST"
                },
                columns     :   [
                    
                    {"data" :   "nomer_aju"},
                    {"data" :   "keterangan","searchable":false},
                    {"data" :   "kondisi",
                        "render" : function(data){
                            if(data==="sukses"){
                                dataRender =  "<span class='col-md-12 btn btn-success'>Sukses</span>";
                            }
                            else{
                                dataRender =  "<span class='col-md-12 btn btn-danger'>Gagal</span>";
                            }
                            return dataRender;
                        }
                    },
                ],
                order       :   [[1,'desc']],
                rowCallback :   function(row,data,iDisplayIndex){
                    var info    =   this.fnPagingInfo();
                    var page    =   info.Ipage;
                    var length  =   info.iLength;
                   
                    $('td:eq(0)',row).html();
                }


            });

            //table produksi
            var table2   =   $("#myTableProduksi").dataTable({
                initComplete : function(){
                    var api = this.api();
                    $('#myTable_filter input')
                        .off('.DT')
                        .on('input.DT',function(){
                            api.search(this.value).draw();
                        });
                },
                oLanguage : {
                    sProcessing : "loading...",
                    sSearchPlaceholder: "search by No Aju"
                },
                processing  :   true,
                serverSide  :   true,
                ajax        :   {
                    "url"   :   "<?php echo base_url('index.php/log/get_all')?>",
                    "type"  :   "POST"
                },
                columns     :   [
                    {"data" :   "nomer_aju"},
                    {"data" :   "keterangan","searchable":false},
                    {"data" :   "kondisi",
                        "render" : function(data){
                            if(data==="sukses"){
                                dataRender =  "<span class='col-md-12 btn btn-success'>Sukses</span>";
                            }
                            else{
                                dataRender =  "<span class='col-md-12 btn btn-danger'>Gagal</span>";
                            }
                            return dataRender;
                        }
                    },
                ],
                order       :   [[1,'desc']],
                rowCallback :   function(row,data,iDisplayIndex){
                    var info    =   this.fnPagingInfo();
                    var page    =   info.Ipage;
                    var length  =   info.iLength;
                   
                    $('td:eq(0)',row).html();
                }


            });

        });
    </script>
</body>
</html>