import { TestBed } from '@angular/core/testing';

import { DadesRazasService } from './dades-razas.service';

describe('DadesRazasService', () => {
  let service: DadesRazasService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(DadesRazasService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
