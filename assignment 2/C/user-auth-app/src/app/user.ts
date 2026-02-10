import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})

export class UserService {
  setUserData(data: any) {
    // Convert the object to a string and save it in the browser's storage
    localStorage.setItem('registeredUser', JSON.stringify(data));
  }

  getUserData() {
    // Retrieve the string and turn it back into an object
    const data = localStorage.getItem('registeredUser');
    return data ? JSON.parse(data) : null;
  }
}