@section('title')
    Food Safety
@endsection

@extends('Users.Partner.layouts.app')

@section('content')

<style>
	h1 {
        margin: 50px 0;
		color:#003366;
		font-weight: bold;
		text-transform:capitalize;
		text-align: center;
    }
    ul {
        list-style-type: none;
        padding-left: 0;
    }
    li {
        margin-bottom: 10px;
    }

	.back_btn {
        display: inline-block;
        padding: 10px 20px;
		margin: 25px 0;
        font-size: 16px;
        color: #fff;
        background-color: #2F4B26;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        text-align: center;
    }

</style>

<body>
	<div class="container">
		<h1>Food Safety Standards for Meals on Wheels Application</h1>

		<p>Welcome to MerryMeal's commitment to food safety! At MerryMeal, we prioritize the safety and quality of our food products. Our food safety standards are designed to ensure that every meal served through our platform meets the highest safety and hygiene standards.</p>
    
    	<p>Below are the key food safety standards we adhere to:</p>

		<ul>
			<li><strong>Hazard Analysis Critical Control Point (HACCP):</strong> Implement a HACCP plan to identify and control food safety hazards.</li>
			<li><strong>Good Manufacturing Practices (GMPs):</strong> Adhere to GMP guidelines to ensure safe and hygienic food handling and processing.</li>
			<li><strong>Traceability and Recall Systems:</strong> Maintain systems to trace food products throughout the supply chain and enable quick recalls if necessary.</li>
			<li><strong>Training and Education:</strong> Provide ongoing training for staff on food safety practices and procedures.</li>
			<li><strong>Risk Assessment and Management:</strong> Conduct regular risk assessments to identify and mitigate potential food safety risks.</li>
			<li><strong>Regulatory Compliance:</strong> Ensure compliance with local, national, and international food safety regulations.</li>
			<li><strong>Monitoring and Verification:</strong> Regularly monitor and verify food safety controls to ensure effectiveness.</li>
		</ul>

		<p>By adhering to these standards, MerryMeal - Meals on Wheels aims to uphold the trust and confidence of our customers and partners, ensuring that every meal delivered through our platform is safe, nutritious, and of the highest quality.</p>

		<a href="javascript:history.go(-1)" class="back_btn">Back</a>
	</div>
</body>
	
@endsection