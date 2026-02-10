import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { Router, RouterModule } from '@angular/router'; // Import both

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [FormsModule, RouterModule], // Use RouterModule here, NOT Router
  templateUrl: './login.html',
  styleUrl: './login.css'
})
export class Login {
  // The 'Router' service goes in the constructor
  constructor(private router: Router) {} 

  loginUser(val: any) {
    console.log("Login data:", val);
    this.router.navigate(['/profile']); // Now this will work
  }
}