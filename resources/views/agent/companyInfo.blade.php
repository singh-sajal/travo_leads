@extends('agent.app.app')

@section('title', 'Company Information')

@section('css')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .back-btn {
            background: white;
            color: black;
            border: none;
            padding: 8px 12px;
            border-radius: 50%;
            cursor: pointer;
        }

        .credits {
            background: #d9534f;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 14px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
        }

        .upload-btn {
            background: #d9534f;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            width: 100%;
            margin-top: 10px;
        }

        .upload-btn:hover {
            background: #c9302c;
        }
    </style>
@endsection

@section('content')
@section('page-title', 'Company Information')



@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form action="{{ route('agent.storeCompanyInfo') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-4">
        <label class="form-label" for="c_name">Company Name</label>
        <input type="text" id="c_name" name="c_name" class="form-control" required>
    </div>

    <div class="mb-4">
        <label class="form-label" for="state">State</label>
        <select class="form-control" id="state" name="state">
            <option>Select State</option>
            <option value="Andhra Pradesh">Andhra Pradesh</option>
            <option value="Bihar">Bihar</option>
            <option value="Delhi">Delhi</option>
            <option value="Goa">Goa</option>
            <option value="Gujarat">Gujarat</option>
            <option value="Haryana">Haryana</option>
            <option value="Karnataka">Karnataka</option>
            <option value="Maharashtra">Maharashtra</option>
            <option value="Punjab">Punjab</option>
            <option value="Rajasthan">Rajasthan</option>
            <option value="Tamil Nadu">Tamil Nadu</option>
            <option value="Uttar Pradesh">Uttar Pradesh</option>
            <option value="West Bengal">West Bengal</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="form-label" for="city">City</label>
        <select class="form-control" id="city" name="city">
            <option>Select City</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="form-label" for="address">Address</label>
        <textarea name="address" id="address" class="form-control" required></textarea>
    </div>

    <div class="mb-4">
        <label class="form-label" for="pincode">Pincode</label>
        <input type="number" id="pincode" name="pincode" class="form-control" required>
    </div>

    <button type="submit" class="upload-btn">Submit</button>
</form>
@endsection

@section('javascript')
<script>
    document.getElementById('company_logo').addEventListener('change', function() {
        if (this.files.length > 0) {
            alert('File selected: ' + this.files[0].name);
        }
    });
</script>

<script>
    const stateCityMap = {
        "Andhra Pradesh": ["Visakhapatnam", "Vijayawada", "Guntur", "Nellore", "Tirupati", "Kakinada",
            "Rajahmundry", "Anantapur", "Kadapa", "Srikakulam"
        ],
        "Arunachal Pradesh": ["Itanagar", "Naharlagun", "Tawang", "Ziro", "Bomdila", "Pasighat", "Roing", "Tezu",
            "Aalo", "Seppa"
        ],
        "Assam": ["Guwahati", "Dibrugarh", "Silchar", "Jorhat", "Nagaon", "Tezpur", "Tinsukia", "Sivasagar",
            "Bongaigaon", "Dhubri"
        ],
        "Bihar": ["Patna", "Gaya", "Bhagalpur", "Muzaffarpur", "Purnia", "Darbhanga", "Bihar Sharif", "Arrah",
            "Begusarai", "Katihar"
        ],
        "Chhattisgarh": ["Raipur", "Bhilai", "Bilaspur", "Korba", "Durg", "Rajnandgaon", "Jagdalpur", "Raigarh",
            "Ambikapur", "Chirmiri"
        ],
        "Goa": ["Panaji", "Margao", "Vasco da Gama", "Mapusa", "Ponda", "Bicholim", "Curchorem", "Canacona",
            "Sanguem", "Valpoi"
        ],
        "Gujarat": ["Ahmedabad", "Surat", "Vadodara", "Rajkot", "Bhavnagar", "Jamnagar", "Gandhinagar", "Junagadh",
            "Anand", "Morbi"
        ],
        "Haryana": ["Gurugram", "Faridabad", "Panipat", "Ambala", "Yamunanagar", "Rohtak", "Hisar", "Sonipat",
            "Panchkula", "Karnal"
        ],
        "Himachal Pradesh": ["Shimla", "Mandi", "Kullu", "Manali", "Dharamshala", "Solan", "Chamba", "Bilaspur",
            "Kangra", "Una"
        ],
        "Jharkhand": ["Ranchi", "Jamshedpur", "Dhanbad", "Bokaro", "Hazaribagh", "Deoghar", "Giridih", "Ramgarh",
            "Medininagar", "Chaibasa"
        ],
        "Karnataka": ["Bangalore", "Mysore", "Hubli", "Mangalore", "Belgaum", "Davangere", "Gulbarga", "Shimoga",
            "Bidar", "Bijapur"
        ],
        "Kerala": ["Thiruvananthapuram", "Kochi", "Kozhikode", "Thrissur", "Kollam", "Palakkad", "Alappuzha",
            "Malappuram", "Kannur", "Kottayam"
        ],
        "Madhya Pradesh": ["Bhopal", "Indore", "Jabalpur", "Gwalior", "Ujjain", "Satna", "Sagar", "Ratlam", "Rewa",
            "Chhindwara"
        ],
        "Maharashtra": ["Mumbai", "Pune", "Nagpur", "Thane", "Nashik", "Aurangabad", "Solapur", "Amravati",
            "Kolhapur", "Nanded"
        ],
        "Manipur": ["Imphal", "Thoubal", "Bishnupur", "Churachandpur", "Kakching", "Senapati", "Ukhrul",
            "Tamenglong", "Jiribam", "Moreh"
        ],
        "Meghalaya": ["Shillong", "Tura", "Nongstoin", "Jowai", "Baghmara", "Williamnagar", "Resubelpara",
            "Mairang", "Khliehriat", "Ampati"
        ],
        "Mizoram": ["Aizawl", "Lunglei", "Saiha", "Champhai", "Serchhip", "Kolasib", "Lawngtlai", "Mamit"],
        "Nagaland": ["Kohima", "Dimapur", "Mokokchung", "Tuensang", "Wokha", "Zunheboto", "Phek", "Mon", "Longleng",
            "Kiphire"
        ],
        "Odisha": ["Bhubaneswar", "Cuttack", "Rourkela", "Berhampur", "Sambalpur", "Balasore", "Bhadrak", "Puri",
            "Jeypore", "Baripada"
        ],
        "Punjab": ["Amritsar", "Ludhiana", "Patiala", "Jalandhar", "Bathinda", "Pathankot", "Mohali", "Firozpur",
            "Phagwara", "Hoshiarpur"
        ],
        "Rajasthan": ["Jaipur", "Jodhpur", "Udaipur", "Kota", "Ajmer", "Bikaner", "Alwar", "Bhilwara", "Sikar",
            "Sri Ganganagar"
        ],
        "Sikkim": ["Gangtok", "Namchi", "Mangan", "Gyalshing", "Ravangla", "Jorethang", "Pelling", "Singtam"],
        "Tamil Nadu": ["Chennai", "Coimbatore", "Madurai", "Tiruchirappalli", "Salem", "Erode", "Vellore",
            "Thoothukudi", "Thanjavur", "Dindigul"
        ],
        "Telangana": ["Hyderabad", "Warangal", "Nizamabad", "Khammam", "Karimnagar", "Ramagundam", "Mahbubnagar",
            "Adilabad", "Suryapet", "Miryalaguda"
        ],
        "Tripura": ["Agartala", "Udaipur", "Dharmanagar", "Kailashahar", "Ambassa", "Belonia", "Khowai"],
        "Uttar Pradesh": ["Lucknow", "Kanpur", "Varanasi", "Agra", "Prayagraj", "Ghaziabad", "Meerut", "Bareilly",
            "Aligarh", "Moradabad"
        ],
        "Uttarakhand": ["Dehradun", "Haridwar", "Roorkee", "Haldwani", "Rudrapur", "Kashipur", "Rishikesh",
            "Nainital", "Pithoragarh", "Almora"
        ],
        "West Bengal": ["Kolkata", "Howrah", "Darjeeling", "Durgapur", "Siliguri", "Asansol", "Bardhaman",
            "Kharagpur", "Malda", "Cooch Behar"
        ]
    };

    document.getElementById('state').addEventListener('change', function() {
        let state = this.value;
        let citySelect = document.getElementById('city');

        // Clear existing options
        citySelect.innerHTML = '<option>Select City</option>';

        if (stateCityMap[state]) {
            stateCityMap[state].forEach(city => {
                let option = document.createElement('option');
                option.value = city;
                option.textContent = city;
                citySelect.appendChild(option);
            });
        }
    });
</script>
@endsection
