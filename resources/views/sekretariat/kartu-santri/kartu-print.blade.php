<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kartu Santri {!! $santri->nama_santri !!}</title>
    <link rel="stylesheet" href="{!! asset('assets/css/bootlize.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/css/lencana.css') !!}">
</head>
<body class="blue">
<div class="container-material mt-5">
<div class="row mb-5">
    <div class="col-md-5">
        <div id="divToPrint" class="lencana idcard">   
            <div class="lencana-container">   
               <div class="lencana-content">
                   <div class="lencana-budged">
                   <div class="row">
                       <div class="col-3 img"><img src="/assets/img/logo/Pondok.png" /></div>
                       <div class="col-9">
                           <div class="size-14">Pondok Pesantren</div>
                           <div class="size-up">Miftahul Huda</div>
                           <div class="size-12">Manonjaya Tasikmalaya Jawa Barat</div>
                       </div>
                   </div><!--/.row-->
                   </div><!--/.lencana-budged-->
                   <div class="lencana-avatar"> 
                   	@if(!$santri->foto == null)
                         <img src="/storage/santri_pic/{!! $santri->foto !!}" alt="PROFIL" title="PROFIL"/> 
                    @else
	                     <img src="/img/avatar_default.jpg" alt="PROFIL" title="PROFIL"/> 
                    @endif
                   </div><!-- profil -->    
                   <div class="lencana-table">
                       <table class="table byepadding byemargin">
                           <tbody>
                               <tr>
                                   <td>NIS</td>
                                   <td>: {!! $santri->nis !!}</td>
                               </tr>
                               <tr>
                                   <td>Nama</td>
                                   <td>: 
                                   		{!! $santri->nama_santri !!}
                                   </td>
                               </tr>
                               <tr>
                                   <td>Alamat</td>
                                   <td>: {!! $santri->alamat !!}</td>
                               </tr>
                           </tbody>
                       </table>
                   </div>
               </div><!-- down player -->   
            </div><!-- dalam player -->   
        </div><!-- player -->  
    </div><!--/.col-->
</div><!--/.row-->
</div><!--/.container-->
</body>
<script type="text/javascript">     
    window.print();
 </script>
</html>