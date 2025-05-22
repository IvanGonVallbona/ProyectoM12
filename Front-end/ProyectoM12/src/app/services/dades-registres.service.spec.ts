import { TestBed } from '@angular/core/testing';

import { DadesRegistresService } from './dades-registres.service';

describe('DadesRegistresService', () => {
  let service: DadesRegistresService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(DadesRegistresService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
