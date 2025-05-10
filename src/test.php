<div style="font-family: Arial, sans-serif; background-color: #06202b; padding: 20px; margin: 0;">
    <div style="width: 100%; max-width: 600px; margin: 0 auto; background-color: #0a2a3a; border-radius: 10px; overflow: hidden; box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);">

        <div style="background-color: #0f3b50; padding: 20px 30px; text-align: center;">
            <h1 style="font-size: 26px; color: #ffffff; margin: 0;">Booking Confirmation</h1>
        </div>

        <div style="padding: 20px 30px; background-color: #0a2a3a; color: #f5eedd;">
            <p style="font-size: 18px; color: #ffffff; margin-top: 0; margin-bottom: 20px;">
                Hi $fname $lname,
            </p>
            <p style="font-size: 16px; line-height: 1.6; margin-bottom: 20px;">
                Thank you for your booking! We are pleased to confirm the details of your reservation:
            </p>

            <div style="margin-bottom: 25px; padding: 15px; background-color: #0f3b50; border-radius: 8px;">
                <h2 style="font-size: 20px; color: #7ae2cf; margin-top: 0; margin-bottom: 15px; border-bottom: 1px solid #06202b; padding-bottom: 10px;">Your Booking Details:</h2>
                <p style="font-size: 16px; margin: 8px 0;"><strong>Booking Code:</strong> $bookingCode</p>
                <p style="font-size: 16px; margin: 8px 0;"><strong>Package Name:</strong> $package_name</p>
                <p style="font-size: 16px; margin: 8px 0;"><strong>Booking Date:</strong> $bookingDate</p>
                <p style="font-size: 16px; margin: 8px 0;"><strong>Check-in Date:</strong> $checkin</p>
                <p style="font-size: 16px; margin: 8px 0;"><strong>Check-out Date:</strong> $checkout</p>
                <p style="font-size: 16px; margin: 8px 0;"><strong>Number of Guests:</strong> $guests</p>
                <p style="font-size: 16px; margin: 8px 0;"><strong>Email:</strong> $email</p>
                <p style="font-size: 16px; margin: 8px 0;"><strong>Payment Status:</strong> <strong style="color: #7ae2cf;">$paymentStatus</strong></p>
            </div>

            <p style="font-size: 16px; line-height: 1.6; margin-bottom: 25px;">
                If you have any questions or need to make changes to your booking, please do not hesitate to contact us.
            </p>

            <p style="text-align: center; margin: 30px 0;">
                <a href="[YourBookingManagementLink]"
                    style="background-color: #077a7d; color: #ffffff; padding: 14px 28px; text-decoration: none; border-radius: 5px; display: inline-block; font-size: 16px; font-weight: bold;">
                    View Your Booking
                </a>
            </p>

            <p style="font-size: 16px; line-height: 1.6;">
                We look forward to welcoming you!
                <br><br>
                Sincerely,
                <br>
                <strong style="color: #ffffff;">The Walawa Cabana Team</strong>
            </p>
        </div>

        <div style="background-color: #0f3b50; padding: 15px 30px; text-align: center;">
            <p style="font-size: 12px; color: #a0aec0; margin: 0;">
                &copy; <?php echo date("Y"); ?> Walawa Cabana Lake Resort. All rights reserved.
            </p>
            <p style="font-size: 12px; color: #a0aec0; margin: 5px 0 0 0;">
                Cipherlix (Pvt) Ltd
            </p>
        </div>
    </div>
</div>