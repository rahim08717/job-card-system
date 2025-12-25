<?php

namespace App\Http\Controllers;

use App\Models\JobCard;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\JobCardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobCardController extends Controller
{
    // Centralized Data Source (To avoid Hardcoding in Views)
    private function getFormData()
    {
        return [
            'vehicleTypes' => ['Sedan Car', 'SUV / Jeep', 'Motorbike', 'Truck/Bus', 'Pickup', 'Van'],
            'fuelTypes' => ['Petrol', 'Diesel', 'CNG', 'LPG', 'Hybrid', 'Electric'],
            'complaintsList' => ['Engine Noise', 'Brake Issue', 'Oil Change', 'AC Not Cooling', 'Electrical Issue', 'Wheel Alignment', 'General Servicing', 'Suspension Noise'],
            'inspectionItems' => ['Engine Oil Level', 'Brake Fluid', 'Radiator Water', 'Battery Condition', 'Tyre Pressure', 'Headlights', 'Tail Lights', 'Indicators', 'AC Cooling', 'Horn', 'Wiper Blades', 'Fuel Level']
        ];
    }

    public function index()
    {
        $jobCards = JobCard::with('vehicle.customer')->latest()->get();
        return view('job_cards.index', compact('jobCards'));
    }

    public function create()
    {
        // Passing data from Controller to View
        return view('job_cards.create', $this->getFormData());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'vehicle_number' => 'required',
            'model' => 'required',
            'services' => 'required|array',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // 1. Customer
                $customer = Customer::firstOrCreate(
                    ['mobile' => $request->mobile],
                    ['name' => $request->name, 'address' => $request->address ?? 'N/A']
                );

                // 2. Vehicle
                $vehicle = Vehicle::updateOrCreate(
                    ['vehicle_number' => $request->vehicle_number],
                    [
                        'customer_id' => $customer->id,
                        'vehicle_type' => $request->vehicle_type,
                        'brand' => $request->brand,
                        'model' => $request->model,
                        'year' => $request->year ?? date('Y'),
                        'engine_no' => $request->engine_no,
                        'chassis_no' => $request->chassis_no, // Optional Field
                        'fuel_type' => $request->fuel_type,
                        'mileage' => $request->mileage,
                    ]
                );

                // 3. Job Card
                $jobNo = 'JOB-' . date('Ymd') . '-' . rand(100, 999);

                $jobCard = JobCard::create([
                    'job_card_no' => $jobNo,
                    'vehicle_id' => $vehicle->id,
                    'entry_date_time' => $request->entry_date_time ?? now(),
                    'expected_delivery_date' => $request->expected_delivery_date,
                    'mechanic_name' => $request->mechanic_name,
                    'customer_complaints' => $request->customer_complaints, // Stores as JSON
                    'inspection_checklist' => $request->inspection_checklist, // Stores as JSON
                    'grand_total' => $request->grand_total,
                    'status' => 'Pending'
                ]);

                // 4. Services
                if ($request->has('services')) {
                    foreach ($request->services as $service) {
                        if (!empty($service['name'])) {
                            $jobCard->services()->create([
                                'service_name' => $service['name'],
                                'price' => $service['price'],
                                'quantity' => $service['quantity'],
                                'total_price' => $service['price'] * $service['quantity']
                            ]);
                        }
                    }
                }
            });

            return redirect()->route('job_cards.index')->with('success', 'Job Card created successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $jobCard = JobCard::with(['vehicle.customer', 'services'])->findOrFail($id);
        return view('job_cards.show', compact('jobCard'));
    }

    public function edit($id)
    {
        $jobCard = JobCard::with(['vehicle.customer', 'services'])->findOrFail($id);

        // Merge JobCard data with Common Data
        $data = array_merge(['jobCard' => $jobCard], $this->getFormData());

        return view('job_cards.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate(['services' => 'required|array']);

        try {
            DB::transaction(function () use ($request, $id) {
                $jobCard = JobCard::findOrFail($id);

                // Update Vehicle Mileage
                $jobCard->vehicle->update(['mileage' => $request->mileage]);

                // Update Job Card Info
                $jobCard->update([
                    'mechanic_name' => $request->mechanic_name,
                    'expected_delivery_date' => $request->expected_delivery_date,
                    'status' => $request->status,
                    'customer_complaints' => $request->customer_complaints,
                    'inspection_checklist' => $request->inspection_checklist,
                    'grand_total' => $request->grand_total,
                ]);

                // Update Services (Delete old, create new)
                $jobCard->services()->delete();

                if ($request->has('services')) {
                    foreach ($request->services as $service) {
                        if (!empty($service['name'])) {
                            $jobCard->services()->create([
                                'service_name' => $service['name'],
                                'price' => $service['price'],
                                'quantity' => $service['quantity'],
                                'total_price' => $service['price'] * $service['quantity']
                            ]);
                        }
                    }
                }
            });

            return redirect()->route('job_cards.index')->with('success', 'Job Card updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $jobCard = JobCard::findOrFail($id);
        $jobCard->delete();
        return redirect()->route('job_cards.index')->with('success', 'Job Card deleted successfully!');
    }
}
