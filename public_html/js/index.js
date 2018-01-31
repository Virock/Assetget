function lagos()
{
    ohSnap('We currently handle only Lagos right now', {'color': 'blue', 'duration': '3000'});
    return;
}

$(document).ready(function ()
{
    document.getElementById('filterForm').style.display = 'none';
    //document.getElementById('maxLandSizeFilter').style.display='none';
    document.getElementById('filterFormJavascript').style.display = 'block';
});

$(document).ready(function ()
{
    $("#chooseAssetFilter").change(function ()
    {
        if (document.getElementById('chooseAssetFilter').value == '')
        {
            $("#assetTypeFilter").load("textdata1/empty.txt");
            document.getElementById("landSizeMax").style.display = 'none';
            document.getElementById("typeFilter").style.display = 'block';
            document.getElementById("space").style.display = 'block';
            document.getElementById("spaceType").style.display = 'none';
            document.getElementById("landSizeMin").style.display = 'none';
            return;
        }
        if (document.getElementById('chooseAssetFilter').value != 'Land')
        {
            document.getElementById("landSizeMax").style.display = 'none';
            document.getElementById("landSizeMin").style.display = 'none';
        }
        if (document.getElementById('chooseAssetFilter').value == 'House')
        {
            $("#assetTypeFilter").load("textdata1/" + $(this).val() + ".txt");
            document.getElementById("typeFilter").style.display = 'block';
            document.getElementById("space").style.display = 'block';
            document.getElementById("spaceType").style.display = 'none';
        }
        if (document.getElementById('chooseAssetFilter').value == 'Car')
        {
            $("#assetTypeFilter").load("textdata1/" + $(this).val() + ".txt");
            document.getElementById("typeFilter").style.display = 'inline-block';
            document.getElementById("space").style.display = 'block';
            document.getElementById("spaceType").style.display = 'none';
        }

        if (document.getElementById('chooseAssetFilter').value == 'Land')
        {
            document.getElementById("typeFilter").style.display = 'none';
            document.getElementById("spaceType").style.display = 'none';
            document.getElementById("space").style.display = 'none';
            document.getElementById("landSizeMax").style.display = 'block';
            document.getElementById("landSizeMin").style.display = 'block';
        }
        if (document.getElementById('chooseAssetFilter').value != 'House' && document.getElementById('chooseAssetFilter').value != 'Car' && document.getElementById('chooseAssetFilter').value != 'Land')
        {
            $("#assetTypeFilter").load("textdata1/empty.txt");
            document.getElementById("typeFilter").style.display = 'none';
            document.getElementById("spaceType").style.display = 'block';
            document.getElementById("space").style.display = 'block';
        }
    });
});

var fileCounter = 0;
Dropzone.options.myAwesomeDropzone =
        {
            maxFilesize: 2, // MB
            maxFiles: 5,
            acceptedFiles: 'image/*',
            autoProcessQueue: false,
            addRemoveLinks: 'dictRemoveFile',
            parallelUploads: 5,
            init: function ()
            {
                var completeChecker = 0;
                var submitButton = document.querySelector("#uploadEntry");
                var deleteButton = document.querySelector("#deleteEntry");
                myDropzone = this;
                submitButton.addEventListener("click", function ()
                {
                    var ownerID = $("#ownerID").val();
                    var chooseAssetID = $("#chooseAssetUploadID").val();
                    var buy = $("#buyID2").val();
                    var price = $("#priceID2").val();
                    if (!$.isNumeric(price))
                    {
                        ohSnap("Enter a valid price. Don't put comma or letters", {'color': 'red', 'duration': '5000'});
                        return;
                    }
                    submitButton.disabled = true;
                    deleteButton.disabled = true;
                    var location = $("#stateID1").val();
                    var type = $("#typeUploadID").val();
                    if ($("#chooseAssetUploadID").val() == 'Land')
                    {
                        type = $("#landSizeCollector1").val();
                    }
                    document.getElementById('uploadEntry').value = 'Uploading';
                    document.getElementById('uploadEntry').disabled = true;
                    var lgaID = $("#lga2").val();
                    var description = $("#descriptionID").val();
                    var dataString1 = '&chooseAsset1=' + chooseAssetID + '&buy1=' + buy + '&price1=' + price + '&location1=' + location + '&type1=' + type + '&lgaID1=' + lgaID + '&description1=' + description + '&ownerID=' + ownerID;
                    $.ajax({
                        type: "POST",
                        url: "handleUpload1.php",
                        data: dataString1,
                        cache: false,
                        success: function (result)
                        {

                        }
                    });

                    myDropzone.processQueue();
                    completeChecker = 1;
                    if (fileCounter == 0)
                    {
                        sessionStorage.setItem('uploadSuccessful', 'true');
                        (function () {
                            alert("Hello")
                        }, 3000);
                        window.setTimeout(function () {
                            document.location.reload(true)
                        }, 2000);
                        document.getElementById('uploadEntry').value = 'Upload ad';
                        document.getElementById('uploadEntry').disabled = false;
                    }
                    fileCounter = 0;
                })
                deleteButton.addEventListener("click", function ()
                {
                    myDropzone.removeAllFiles();
                    document.getElementById('descriptionID').value = '';
                    document.getElementById('priceID2').value = '';
                    document.getElementById('landSizeCollector1').value = '';
                })
                this.on("queuecomplete", function (file)
                {
                    if (completeChecker == 1)
                    {
                        myDropzone.removeAllFiles();
                        document.getElementById('uploadEntry').value = 'Upload ad';
                        document.getElementById('uploadEntry').disabled = false;
                        sessionStorage.setItem('uploadSuccessful', 'true');
                        window.setTimeout(function () {
                            document.location.reload(true)
                        }, 2000);
                    }
                })
                this.on("addedfile", function (file)
                {
                    fileCounter++;
                })
                this.on("removedfile", function (file)
                {
                    fileCounter--;
                })
            },
        };

$(document).ready(function ()
{
    $("#chooseAssetUploadID").change(function ()
    {
        if (document.getElementById('chooseAssetUploadID').value == 'House')
        {
            $("#typeUploadID").load("textdata/House.txt");
            document.getElementById("typeUploadContainerID").style.display = 'block';
            document.getElementById("spaceLand").style.display = 'block';
            document.getElementById("landSizeUploadID").style.display = 'none';
            document.getElementById("spaceState").style.display = 'none';
            return;
        } else if (document.getElementById('chooseAssetUploadID').value == 'Car')
        {
            $("#typeUploadID").load("textdata/Car.txt");
            document.getElementById("typeUploadContainerID").style.display = 'block';
            document.getElementById("spaceLand").style.display = 'block';
            document.getElementById("landSizeUploadID").style.display = 'none';
            document.getElementById("spaceState").style.display = 'none';
            return;
        } else if (document.getElementById('chooseAssetUploadID').value == 'Land')
        {
            $("#typeUploadID").load("textdata/empty.txt");
            document.getElementById("typeUploadContainerID").style.display = 'none';
            document.getElementById("spaceLand").style.display = 'none';
            document.getElementById("spaceState").style.display = 'block';
            document.getElementById("landSizeUploadID").style.display = 'block';
            return;
        } else
        {
            $("#typeUploadID").load("textdata/empty.txt");
            document.getElementById("typeUploadContainerID").style.display = 'none';
            document.getElementById("spaceLand").style.display = 'block';
            document.getElementById("spaceState").style.display = 'block';
            document.getElementById("landSizeUploadID").style.display = 'none';
            return;
        }
    });
});