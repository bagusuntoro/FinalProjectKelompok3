<template>
    <div id="template">
        <div class="row">
            <div class="col-md-4">
                <h4 class="customVendorText">Vendor Invoice</h4>
            </div>
            <div class="col-md-5"></div>
            <div class="col-md-3">
                <button class="customButtonCreate">+ Add Vendor Invoice</button>
            </div>
        </div>

        <div class="row">
            <table class="table m-auto">
                <thead>
                    <tr>
                        <th>Invoice No.</th>
                        <th>Invoice Attachment</th>
                        <th>Supporting Document</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>tes</td>
                        <td>tes</td>
                        <td>tes</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: center;">
                            <div class="row customReceived">
                                <div class="col-md-3"></div>
                                <div class="col-md-3">
                                    <p>Click the button if all vendor invoices have been received</p>
                                </div>
                                <div class="col-md-3">
                                    <button class="customButtonReceived">All Received</button>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style scoped>
#template {
    width: 98%;
    height: 500px;
    background-color: #ffffff;
    box-shadow: 5px 5px 8px #888888;
    border-radius: 10px;
}

.customVendorText{
    margin: 20px 0 0 30px;
    color: #5e5e5e;
}

.customButtonCreate{
    margin:20px 20px 0 0 !important;
    padding: 7px 0 7px 0;
    width: 200px;
    border-radius: 5px;
    background-color: #1dccb5;
    font-weight: bold;
    color:white;
    border:0;
}


.customReceived{
    /* width: 200px; */
    /* justify-content: center !important; */
}

.customButtonReceived{
    padding: 7px 0 7px 0;
    width: 200px;
    border-radius: 5px;
    background-color: #1dccb5;
    font-weight: bold;
    color:white;
    border:0;
}


table {
    margin-top: 30px !important;
    width: 90%;
}
thead {
    background-color: #bbbbbb;
    color: white;
}
</style>