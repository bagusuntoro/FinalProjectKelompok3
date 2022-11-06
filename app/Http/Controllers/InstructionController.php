<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Instruction;
use Illuminate\Http\Request;
use App\Models\NotesByInternals;
use App\Http\Controllers\Controller;

class InstructionController extends Controller
{
    public function showAll()
    {
        $instructionsModel = new Instruction();
        $instructions = $instructionsModel->get();

        return response()->json($instructions);
    }

    public function storeData(Request $request)
    {
        $request->validate([
            'instruction_id' => 'required',
            'link_to' => 'required',
            'instruction_type' => 'required',
            'assigned_vendor' => 'required',
            'attention_of' => 'required',
            'quotation_no' => 'required',
            'customer_po' => 'required',
            'attachment' => 'required',
            'note' => 'required',
            'link_to' => 'required',
        ]);

        $detail_cost = $this->insertMultipleCostDetail($request);
        // $detail_cost = [
        //     'description' => $request['description'],
        //     'qty' => $request['qty'],
        //     'uom' => $request['uom'],
        //     'unit_price' => $request['unit_price'],
        //     'gst_vat' => $request['gst_vat'],
        //     'currency' => $request['currency'],
        //     'total' => $request['total'],
        //     'charge_to' => $request['charge_to'],
        // ];

        $data = [
            'instruction_id' => $request['instruction_id'],
            'link_to' => $request['link_to'],
            'instruction_type' => $request['instruction_type'],
            'assigned_vendor' => $request['assigned_vendor'],
            'attention_of' => $request['attention_of'],
            'quotation_no' => $request['quotation_no'],
            'customer_po' => $request['customer_po'],
            'status' => 'On Progress',
            'cost_detail' => $detail_cost,
            'attachment' => $request['attachment'],
            'note' => $request['note'],
            'link_to' => $request['link_to'],
            'vendor_invoice' => [],
        ];

        $user = auth()->user()->name;

        $history = [
            'instruction_id' => $request['instruction_id'],
            'history_data' => [
                'action' => 'Created',
                'by_user' => $user,
                'notes' => '',
                'attachment' => '',
            ]
        ];

        // $this->instService->addData($data);
        // $this->notesService->addData($history);
        
        Instruction::create($data);
        NotesByInternals::create($history);
    }

    
    protected function insertMultipleCostDetail(Request $request)
    {
        $data = [];
        $detail = [];
        for ($i=1 ; $i <= count($request["cost_detail"]) ; $i++) { 
            $data["_id"] = $i;
            $data["description"] = $request["cost_detail.detail$i.description"];
            $data["qty"] = $request["cost_detail.detail$i.qty"];
            $data["uom"] = $request["cost_detail.detail$i.uom"];
            $data["unit_price"] = $request["cost_detail.detail$i.unit_price"];
            $data["gst_vat"] = $request["cost_detail.detail$i.gst_vat"];
            $data["currency"] = $request["cost_detail.detail$i.currency"];
            $data["total"] = $request["cost_detail.detail$i.total"];
            $data["charge_to"] = $request["cost_detail.detail$i.charge_to"];
            array_push($detail, $data);
        }       
        return $detail;
    }
}
