

<?php $__env->startSection('title', 'Choose Interest'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="text-center mb-4">
        <h1 style="text-align: center; color:#003366; font-weight: bold; margin: 25px 0;">Select Your Interest</h1>
    </div>
    <div class="row justify-content-center">
        <!-- Member Box -->
        <div class="col-md-4 mb-4 text-center">
            <img src="<?php echo e(asset('images/member.jpg')); ?>" alt="Member" class="img-fluid mb-3">
            <p>If you are a senior in need of support, we are here to serve you. Join our program to receive nourishing meals and care tailored to your needs.</p>
            <a href="<?php echo e(route('register.form')); ?>?interest=member" class="btn btn-primary">Member</a>
        </div>


        <!-- Volunteer Box -->
        <div class="col-md-4 mb-4 text-center">
            <img src="<?php echo e(asset('images/volunteer.jpeg')); ?>" alt="Member" class="img-fluid mb-3">
            <p>Help us make a difference by volunteering your time and skills. Your support enhances our ability to serve the community effectively.</p>
            <a href="<?php echo e(route('register.form')); ?>?interest=volunteer" class="btn btn-primary">Volunteer</a>
        </div>

        <!-- Partner Box -->
        <div class="col-md-4 mb-4 text-center">
            <img src="<?php echo e(asset('images/partner3.jpg')); ?>" alt="Member" class="img-fluid mb-3">
            <p>Join us as a partner to support our mission through collaboration and resources. Together, we can achieve greater impact.</p>
            <a href="<?php echo e(route('register.form')); ?>?interest=partner" class="btn btn-primary">Partner</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .interest-box {
        display: flex; 
        flex-direction: column; 
        align-items: center; 
        justify-content: center; 
        text-decoration: none;
        color: #000;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        transition: background-color 0.3s ease;
        margin-bottom: 20px; 
        height: 300px; 
    }

    .interest-box:hover {
        background-color: #f0f0f0;
    }

    .interest-box img {
        width: 100%;
        height: 200px; 
        object-fit: cover; 
        border-radius: 8px;
    }

    .interest-box h3 {
        margin-top: 10px;
        font-size: 1.25rem;
        text-align: center; 
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Apache\htdocs\Meals_On_Wheels_Project (1)\resources\views/auth/choose_interest.blade.php ENDPATH**/ ?>