import { Component } from '@angular/core';
import { ApiService } from '../api.service';

@Component({
  selector: 'app-tableau',
  templateUrl: './tableau.component.html',
  styleUrls: ['./tableau.component.scss']
})
export class TableauComponent {
  constructor (private apiService:ApiService) { }
  affichage!: any
  ngOnInit(){
    this.apiService.getUser().subscribe((donnee: []) => {
      console.log(donnee)
      this.affichage = donnee
    })
  }
}
