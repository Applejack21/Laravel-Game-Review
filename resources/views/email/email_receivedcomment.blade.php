<html>
<body bgcolor="#F8F8F8">

<table width=691px style="margin-left:5px;" border="0" cellpadding="0" cellspacing="0">
	<tbody>
    	
        <tr>
        	<td style="padding-left:14px;padding-bottom:17px;"><span style="font-size:35px;font-family:Segoe UI, Arial, Calibri, sans-serif;font-weight:bold;"> <span style="color:#2e6e9e;">Hello, {{$reviewerUsername}} </span><br></span>
			</td>
		</tr>
        <tr>
        	<td valign="top" width="691" height="20" style="background-color:#2e6e9e; margin-left:10px;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;vertical-align:middle; width:691px;overflow:hidden;margin-left:12px;font-family:Segoe UI, Arial, Calibri, sans-serif;color:#fff;" ></td>
		</tr>
        	<td align="left" valign="top">

	<table style="width: 705px;" border="0" cellpadding="0" cellspacing="0">
		<tbody>
        
        	<td align="left" bgcolor="#FFFFFF" valign="top" width="691" style="padding-left:14px;padding-right:14px;padding-top:4px;padding-bottom:4px; border-left:1px solid #ddd; border-right:1px solid #ddd; border-bottom:1px solid #ddd;-webkit-border-bottom-right-radius: 5px;-webkit-border-bottom-left-radius: 5px;-moz-border-radius-bottomright: 5px;-moz-border-radius-bottomleft: 5px;border-bottom-right-radius: 5px;border-bottom-left-radius: 5px;">

<table width=664px border="0" cellpadding="0" cellspacing="0">
		<tr>
		<td style="font-family:Segoe UI, Arial, Calibri, sans-serif; font-size: 15px; color: #000000; line-height: 21px;" align="left" valign="top">You're receiving this email because someone has recently left a comment on one of your reviews. Information about that can be seen below.<br><br></td>
	</tr> 
<br>
<table width="auto">        
     <tr>
        <td style="background-color:#E5E4E2;font-family:Segoe UI, Arial, Calibri, sans-serif;font-size: 15px;font-weight:bold;padding:2px;padding-left:5px;" width="auto">Review Title:</td>
        <td style="background-color:#E5E4E2;font-family:Segoe UI, Arial, Calibri, sans-serif;font-size: 15px;padding:2px;padding-left:5px;" width="auto">{{$reviewertitle}}</td>
    </tr>
    <tr>
    	<td style="background-color:#E5E4E2;font-family:Segoe UI, Arial, Calibri, sans-serif;font-size: 15px;font-weight:bold;padding:2px;padding-left:5px;" width="auto">Comment By:</td> 
        <td style="background-color:#EFEEEC;font-family:Segoe UI, Arial, Calibri, sans-serif;font-size: 15px;padding:2px;padding-left:5px;" width="auto">{{$commenterusername}}</td>
 	</tr>
    <tr>
        <td style="background-color:#E5E4E2;font-family:Segoe UI, Arial, Calibri, sans-serif;font-size: 15px;font-weight:bold;padding:2px;padding-left:5px;" width="auto">Comment:</td> 
        <td style="background-color:#EFEEEC;font-family:Segoe UI, Arial, Calibri, sans-serif;font-size: 15px;padding:2px;padding-left:5px;" width="auto">{!! nl2br(e($comment)) !!}</td>
    </tr>
    </table>
<table>
<br>
    <tr>
    	<td style="font-family:Segoe UI, Arial, Calibri, sans-serif; font-size: 15px; color: #000000; line-height: 21px;" align="left" valign="top">You can view this comment via the link below:<br><br></td>
    </tr>
    <tr>
        <td><a href="{{url('details/'.$reviewid).'#reviewcomment'}}" style="background-color:#2e6e9e;border:5px solid #2e6e9e;border-radius:3px;color:#fefefe;display:inline-block;font-family:sans-serif;font-size:16px;line-height:44px;text-align:center;text-decoration:none;width:auto;-webkit-text-size-adjust:none;mso-hide:all;">{{$reviewertitle}}</a></td>
    </tr>
    <br>
	<tr>
    	<td style="font-family:Segoe UI, Arial, Calibri, sans-serif; font-size: 15px; color: #000000; line-height: 21px;" align="left" valign="top">Kind regards,</td>
	</tr>
    
    <tr>	
    <td style="font-family:Segoe UI, Arial, Calibri, sans-serif; font-size: 15px; color: #000000; line-height: 21px;" align="left" valign="top">Review System<br><br></td>
    </tr>
</table>
</html>
