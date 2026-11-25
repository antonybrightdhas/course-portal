function AddComment(ID,cmid)
{

	if(document.getElementById(ID).style.display=="none")
	{
               Popup.showModal(ID);
			   document.form3.cmid.value=cmid;
        }
       	else
	{
               	Popup.hide(ID);
	}
}
function DownFile(ID)
{

	if(document.getElementById(ID).style.display=="none")
	{
               Popup.showModal(ID);
        }
       	else
	{
               	Popup.hide(ID);
	}
}
