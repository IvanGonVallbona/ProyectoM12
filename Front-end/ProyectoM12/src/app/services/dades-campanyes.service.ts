import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { ICampanya } from '../interfaces/icampanya';

@Injectable({
  providedIn: 'root'
})
export class DadesCampanyesService {

  constructor(private _http: HttpClient) { }

  listCampanyes(): Observable<HttpResponse<ICampanya[]>> {
    return this._http.get<ICampanya[]>('/api/campanyes', { observe: 'response' });
  }

  newCampanya(dada: any): Observable<HttpResponse<ICampanya>> {
    return this._http.post<ICampanya>('/api/campanya', dada, { observe: 'response' });
  }

  getCampanya(id: any): Observable<HttpResponse<ICampanya>> {
    return this._http.get<ICampanya>(`api/campanya/${id}`, { observe: 'response' });
  }

  editCampanya(id: any, dada: any): Observable<HttpResponse<ICampanya>> {
    return this._http.put<ICampanya>(`api/campanya/${id}`, dada, { observe: 'response' });
  }

  deleteCampanya(id: any): Observable<HttpResponse<void>> {
    return this._http.delete<void>(`/api/campanya/${id}`, { observe: 'response' });
  }
}
