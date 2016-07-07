
<HTML>
<HEAD>
<TITLE>Exemplo Itaú Shopline</TITLE>
</HEAD>
<BODY>
<FORM action=”https://shopline.itau.com.br/shopline/shopline.aspx” method=”post”
name=”form” onsubmit=carregabrw() target=”SHOPLINE”>
<CENTER> Dados</CENTER>
<TABLE width=”100%” border=1 align=center>
<TR>
<TD WIDTH=25% ALIGN=center><B>Seu Pedido:<B/></TD>
<TD><?php echo $row[“pedido”]; ?></TD>
</TR>
<TR>
<TD WIDTH=25% ALIGN=center><B>Total a Pagar:<B/></TD>
<TD><?php echo $row[“valor”]; ?></TD>
</TR>
<TR>
<TD WIDTH=25% ALIGN=center><B>Observação:<B/></TD>
<TD><?php echo $row[“observacao”]; ?></TD>
</TR>
<TR>
<TD WIDTH=25% ALIGN=center><B>Nome do Sacado:<B/></TD>
<TD><?php echo $row[“nomeSacado”]; ?></TD>
</TR>
<TR>
<TD WIDTH=25% ALIGN=center><B>Código de Inscrição:<B/></TD>
<TD><?php echo $row[“codigoInscricao”]; ?></TD>
</TR>
<TR>
<TD WIDTH=25% ALIGN=center><B>Número de Inscrição(CPF/CNPJ):<B/></TD>
<TD><?php echo $row[“numeroInscricao”]; ?></TD>
</TR>
<TR>
<TD WIDTH=25% ALIGN=center><B>Endereço do Sacado:<B/></TD>
<TD><?php echo $row[“enderecoSacado”]; ?></TD>
</TR>
<TR>
<TD WIDTH=25% ALIGN=center><B>Bairro:<B/></TD>
<TD><?php echo $row[“bairroSacado”]; ?></TD>
</TR>
<TR>
<TD WIDTH=25% ALIGN=center><B>CEP:<B/></TD>
<TD><?php echo $row[“cepSacado”]; ?></TD>
</TR>
<TR>
<TD WIDTH=25% ALIGN=center><B>Cidade:<B/></TD>
<TD><?php echo $row[“cidadeSacado”]; ?></TD>
</TR>
<TR>
<TD WIDTH=25% ALIGN=center><B>Estado:<B/></TD>
<TD><?php echo $row[“estadoSacado”]; ?></TD>
</TR>
<TR>
<TD WIDTH=25% ALIGN=center><B>Data de Vencimento(ddmmaaaa):<B/></TD>
<TD><?php echo $row[“dataVencimento”]; ?></TD>
</TR>
<TR>
<TD WIDTH=25% ALIGN=center><B>URL de Retorno:<B/></TD>
<TD><?php echo $row[“urlRetorna”]; ?></TD>

</TR>
<TR>
<TD WIDTH=25% ALIGN=center><B>Observação Adicional1:<B/></TD>
<TD><?php echo $row[“obsAd1”]; ?></TD>
</TR>
<TR>
<TD WIDTH=25% ALIGN=center><B>Observação Adicional2:<B/></TD>
<TD><?php echo $row[“obsAd2”]; ?></TD>
</TR>
<TR>
<TD WIDTH=25% ALIGN=center><B>Observação Adicional3:<B/></TD>
<TD><?php echo $row[“obsAd3”]; ?></TD>
</TR>
</TABLE>
<?php
$codEmp =”J0012345678901234567890123”;
$pedido =”98988812”;
$valor =”0,01”;
$observacao =””;
$chave=”A3G8E4C19N6W7BPS”;
$nomeSacado =””;
$codigoInscricao =””;
$numeroInscricao =””;
$enderecoSacado =””;
$bairroSacado =””;
$cepSacado =””;
$cidadeSacado =””;
$estadoSacado =””;
$dataVencimento =””;
$urlRetorna =””;
$obsAd1 =””;
$obsAd2 =””;
$obsAd3 =””;
function CreateObject()
{
$COM = new Java(‘Itau.Itaucripto’);
return $COM;
}
$cripto = CreateObject();
$dados=$cripto->geraDados($codEmp,$pedido,$valor,$observacao,$chave,$n
omeSacado,$codigoInscricao,$numeroInscricao,$enderecoSacado,$bairroSacado,$cepSac
ado,$cidadeSacado,$estadoSacado,$dataVencimento,$urlRetorna,$obsAd1,$obsAd2,$obs
Ad3);
// echo “<br><br>”.$dados;
? >
<CENTER>
<BR><BR>
<INPUT type=”hidden” name=”DC” value=”<? echo $dados; ?>”>
<BR>
<INPUT type=”submit” name=”Shopline” value=”Itaú Shopline”>
</FORM>
<script language=”JavaScript”>
function carregabrw()
{
window.open(‘’,’SHOPLINE’,”toolbar=yes,menubar=yes,resizable=yes,status=no,scrollbars=y
es,width=815,height=575”);
}
</script>
<BODY>
</HTML>