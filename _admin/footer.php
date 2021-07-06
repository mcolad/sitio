<!-- MODAL -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"  aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
<!--            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Top</h4>
            </div>
-->        <div class="modal-body" style="height:650px">
        <iframe frameborder="0"></iframe>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn" onClick="javascript:window.location.reload()" data-dismiss="modal">Cerrar</button>
        <!--<button type="button" class="btn btn_admin" data-dismiss="modal">Cerrar</button>-->
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalsinReload" tabindex="-1" role="dialog"  aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
<!--            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Top</h4>
            </div>
-->        <div class="modal-body" style="height:650px">
        <iframe frameborder="0"></iframe>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal">Cerrar</button>
        <!--<button type="button" class="btn btn_admin" data-dismiss="modal">Cerrar</button>-->
        </div>
        </div>
    </div>
</div>


<div style="width:max-width: 100%; important!" class="modal fade" id="myModalsinReload100" tabindex="-1" role="dialog"  aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width:100%">
        <div class="modal-content">
<!--            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Top</h4>
            </div>
-->        <div class="modal-body" style="height:650px">
        <iframe frameborder="0"></iframe>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal">Cerrar</button>
        <!--<button type="button" class="btn btn_admin" data-dismiss="modal">Cerrar</button>-->
        </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModal_adj" tabindex="-1" role="dialog"  aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
<!--            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Top</h4>
            </div>
-->        <div class="modal-body" style="height:650px">
        <iframe frameborder="0"></iframe>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal">Cerrar</button>
        <!--<button type="button" class="btn btn_admin" data-dismiss="modal">Cerrar</button>-->
        </div>
        </div>
    </div>
</div>

<script>
$('button.modalButton').on('click', function(e) {
    var src = $(this).attr('data-src');
 //   var height = $(this).attr('data-height') || 300;
 //   var width = $(this).attr('data-width') || 400;
    
    $("#myModal iframe").attr({'src':src,
                        'height':'600px',
                        'width':'100%'});
    
    $("#myModalsinReload iframe").attr({'src':src,
                        'height':'600px',
                        'width':'100%'});

    $("#myModalsinReload100 iframe").attr({'src':src,
                        'height':'600px',
                        'width':'100%'});

	$("#myModal_adj iframe").attr({'src':src,
                        'height':'600px',
                        'width':'100%'});
});
</script>
<!--FIN MODAL -->

