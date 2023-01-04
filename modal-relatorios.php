
<!--  Modal Rel Servicos-->
<div class="modal fade" id="ModalRelServicos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Relatório de Serviços</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>



            <form action="../rel/rel_servicos.php" method="POST" target="_blank">
                <div class="modal-body">

                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >Data Inicial</label>
                            <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control"  name="dataInicial" >
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label >Data Final</label>
                            <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control"  name="dataFinal" >
                        </div>


                    </div>

                </div>     

            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary">Gerar Relatório</button>
            </div>
        </form>


    </div>
</div>
</div>


<!--  Modal Rel Mov-->
<div class="modal fade" id="ModalRelMov" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Relatório de Movimentações</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>



            <form action="../rel/rel_mov.php" method="POST" target="_blank">
                <div class="modal-body">

                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >Data Inicial</label>
                            <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control"  name="dataInicial" >
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label >Data Final</label>
                            <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control"  name="dataFinal" >
                        </div>


                    </div>


                </div>     

            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary">Gerar Relatório</button>
            </div>
        </form>


    </div>
</div>
</div>





<!--  Modal Rel Pagar-->
<div class="modal fade" id="ModalRelPagar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Contas à Pagar</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>



            <form action="../rel/rel_pagar.php" method="POST" target="_blank">
                <div class="modal-body">

                 <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label >Data Inicial</label>
                            <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control"  name="dataInicial" >
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="form-group">
                            <label >Data Final</label>
                            <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control"  name="dataFinal" >
                        </div>


                    </div>

                    <div class="col-md-4">

                        <div class="form-group">
                            <label >Pago</label>
                            <select class="form-control" name="status" >
                                <option value="">Todas</option>
                                <option value="Sim">Sim</option>
                                <option value="Não">Não</option>
                               
                            </select>
                        </div>


                    </div>

                </div>     

            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary">Gerar Relatório</button>
            </div>
        </form>


    </div>
</div>
</div>







<!--  Modal Rel Receber-->
<div class="modal fade" id="ModalRelReceber" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Contas à Receber</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>



            <form action="../rel/rel_receber.php" method="POST" target="_blank">
                <div class="modal-body">

                 <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label >Data Inicial</label>
                            <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control"  name="dataInicial" >
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="form-group">
                            <label >Data Final</label>
                            <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control"  name="dataFinal" >
                        </div>


                    </div>

                    <div class="col-md-4">

                        <div class="form-group">
                            <label >Pago</label>
                            <select class="form-control" name="status" >
                                <option value="">Todas</option>
                                <option value="Sim">Sim</option>
                                <option value="Não">Não</option>
                               
                            </select>
                        </div>


                    </div>

                </div>     

            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary">Gerar Relatório</button>
            </div>
        </form>


    </div>
</div>
</div>







<!--  Modal Rel Compras-->
<div class="modal fade" id="ModalRelCompras" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Relatório de Compras</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>



            <form action="../rel/rel_compras.php" method="POST" target="_blank">
                <div class="modal-body">

                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >Data Inicial</label>
                            <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control"  name="dataInicial" >
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label >Data Final</label>
                            <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control"  name="dataFinal" >
                        </div>


                    </div>

                   

                </div>     

            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary">Gerar Relatório</button>
            </div>
        </form>


    </div>
</div>

<!--  Modal Rel Vales-->
<div class="modal fade" id="ModalRelVales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Relatório de Vales</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>



            <form action="../rel/rel_vales.php" method="POST" target="_blank">
                <div class="modal-body">

                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >Data Inicial</label>
                            <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control"  name="dataInicial" >
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label >Data Final</label>
                            <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control"  name="dataFinal" >
                        </div>


                    </div>

                   

                </div>     

            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary">Gerar Relatório</button>
            </div>
        </form>


    </div>
</div>
</div>






