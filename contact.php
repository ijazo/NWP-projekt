<?php 
	print '
	<h1>Kontaktirajte nas!</h1>
	<div id="contact">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d44939.3178780206!2d17.349852195419793!3d45.25370994921023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4767619efe8db575%3A0x400ad50862bc650!2s35400%2C%20Nova%20Gradi%C5%A1ka!5e0!3m2!1shr!2shr!4v1590074910526!5m2!1shr!2shr" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
		<form action="http://work2.eburza.hr/pwa/responsive-page/html/send-contact.php" id="contact_form" name="contact_form" method="POST">
			<label for="fname">Ime *</label>
			<input type="text" id="fname" name="firstname" placeholder="Vaše ime.." required>
			
			<label for="lname">Prezime *</label>
			<input type="text" id="lname" name="lastname" placeholder="Vaše prezime.." required>
				
			<label for="email">E-mail *</label>
			<input type="email" id="email" name="email" placeholder="Vaš email" required>

			<label for="country">Država</label>
			<select id="country" name="country">
			<option value="">Odaberite državu</option>';
			#Select all countries from database webprog, table countries
			$query  = "SELECT * FROM countries";
			$result = @mysqli_query($MySQL, $query);
			while($row = @mysqli_fetch_array($result)) {
			print '<option value="' . $row['country_code'] . '">' . $row['country_name'] . '</option>';
			}
			print'
			</select>

			<label for="subject">Vaš upit</label>
			<textarea id="subject" name="subject" placeholder="Napišite nešto.." style="height:200px"></textarea>

			<input type="submit" value="Pošalji">
		</form>
	</div>';
?>