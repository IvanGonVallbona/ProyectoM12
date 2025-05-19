import { TestBed } from '@angular/core/testing';

import { DadesCampanyesService } from './dades-campanyes.service';

describe('DadesCampanyesService', () => {
  let service: DadesCampanyesService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(DadesCampanyesService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
