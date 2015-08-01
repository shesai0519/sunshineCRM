<?php
/*
版权归属:郑州单点科技软件有限公司;
联系方式:0371-69663266;
公司地址:河南郑州经济技术开发区第五大街经北三路通信产业园四楼西南;
公司简介:郑州单点科技软件有限公司位于中国中部城市-郑州,成立于2007年1月,致力于把基于先进信息技术（包括通信技术）的最佳管理与业务实践普及到教育行业客户的管理与业务创新活动中，全面提供具有自主知识产权的教育管理软件、服务与解决方案，是中部最优秀的高校教育管理软件及中小学校管理软件提供商。目前己经有多家高职和中职类院校使用通达中部研发中心开发的软件和服务;

软件名称:单点科技软件开发基础性架构平台,以及在其基础之上扩展的任何性软件作品;
发行协议:数字化校园产品为商业软件,发行许可为LICENSE方式;单点CRM系统即SunshineCRM系统为GPLV3协议许可,GPLV3协议许可内容请到百度搜索;
特殊声明:软件所使用的ADODB库,PHPEXCEL库,SMTARY库归原作者所有,余下代码沿用上述声明;
*/

function workplanselect_add($fields, $i )
{
	global $db,$_SESSION,$common_html;
$notnull=trim($fields['null'][$i]['inputtype']);
$notnull=='notnull'?$notnulltext=$common_html['common_html']['mustinput']:$notnulltext='';

$fieldname1=$fields['name'][$i];

$class = "SmallSelect";

print "<script type=\"text/javascript\" language=\"javascript\" src=\"".ROOT_DIR."general/ERP/Enginee/jquery/jquery.js\"></script>";
print "<script language=javascript>
var $$ = jQuery.noConflict();
function sendRequest(action,params) {	
     $$.ajax({ 
		  type:'GET', 
		  url:'workplanmain_detail_newai.php?action='+action+'&' + params, 
		  dataType: 'xml', 
		  cache:false,
		  success:function(data) 
		  { 
		
	   		  	 $$(data).find('workplanmaindetail').each(function() {
      		
						var begintime=$$(this).find('begintime').text();
						var endtime=$$(this).find('endtime').text();
						var content=$$(this).find('content').text();
						var result=$$(this).find('result').text();
						document.getElementById('yuchuzhi').innerHTML=document.getElementById('yuchuzhi').innerHTML+'<br>'+begintime+' - '+endtime+'  '+content+' ';
                    });				
		  },
		  error:function(XmlHttpRequest,textStatus, errorThrown)
	      {
			  var errorPage = XmlHttpRequest.responseText;  
			  alert('获取联系人出错：'+errorThrown);
	      }
	});
}


function showCartInfo_supplylinkman() {
    if (xmlHttp.readyState == 4) {
        if(xmlHttp.responseText.indexOf(\"root\")==-1)
        	{
				alert(xmlHttp.responseText);
				return false;
        	}
    		var doc = new ActiveXObject(\"MSxml2.DOMDocument\");
   		 	doc.loadXML(xmlHttp.responseText);
   		 	var rootnode = doc.getElementsByTagName(\"root\")[0];
   		
			var detailnode = doc.getElementsByTagName(\"workplanmaindetail\")[0];
		
			while(detailnode!=null)
			{
					var begintime=detailnode.childNodes[0].childNodes[0].nodeValue;
					var endtime=detailnode.childNodes[1].childNodes[0].nodeValue;
					var content=detailnode.childNodes[2].childNodes[0].nodeValue;
					var result=detailnode.childNodes[3].childNodes[0].nodeValue;
					document.getElementById('yuchuzhi').innerHTML=document.getElementById('yuchuzhi').innerHTML+'<br>'+begintime+' - '+endtime+'  '+content+' ';
					detailnode=detailnode.nextSibling;
			}
			
    }
};
function changelocation1(locationid)
{
	document.getElementById('yuchuzhi').innerHTML='';
    sendRequest('workplandetail','id='+locationid);
}

function LoadSupplyWindow(URL,fieldnameID,fieldname)
{

	//window.showModalDialog(URL,self,'edge:raised;scroll:0;status:0;help:0;resizable:1;dialogWidth:320px;dialogHeight:285px;dialogTop:'+loc_y+'px;dialogLeft:'+loc_x+'px');
	SelectAllInforSingle(URL,'',fieldnameID, fieldname);
	var newid=form1.".$fieldname1.".value;
	changelocation1(newid);
}
";

if($fields['value'][$fieldname1]!='')
{
	
	print "
	function initloadchange()
	{
		changelocation1(".$fields['value'][$fieldname1].");
	}
	if (document.all){

		window.attachEvent('onload',initloadchange)//IE中

		}

	else{

		window.addEventListener('load',initloadchange,false);//firefox

	}
	
	";
}
print "
</SCRIPT>\n";

$supplyname=returntablefield("workplanmain", "id", $fields['value'][$fieldname1], "zhuti");
$fieldnameID = $fieldname1."_ID";
print "<TR><TD class=TableData noWrap>计划安排:</TD><TD class=TableData noWrap>\n";
print "<input type=\"hidden\"  name=\"$fieldname1\" value=\"".$fields['value'][$fieldname1]."\">";
print "<input name=\"".$fieldnameID."\" value=\"".$supplyname."\" class=\"SmallStatic\" readonly size=30>&nbsp;\n";
print "<input type=\"button\" title='' value=\"选择\" class=\"SmallButton\" onClick=\"LoadSupplyWindow('../../Enginee/Module/workplan_select_single/index.php','$fieldnameID', '$fieldname1');\" >&nbsp;$notnulltext";
print "</TD></TR>\n";
print "<TR><TD class=TableData noWrap>执行记录:</TD><TD class=TableData noWrap><div id='yuchuzhi'></div></TD></TR>\n";


}


function SupplyLinkmanPriv_value_PRIV( $fieldvalue, $fields, $i )
{

}

?>
