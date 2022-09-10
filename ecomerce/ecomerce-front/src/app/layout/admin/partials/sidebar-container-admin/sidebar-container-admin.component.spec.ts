import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SidebarContainerAdminComponent } from './sidebar-container-admin.component';

describe('SidebarContainerAdminComponent', () => {
  let component: SidebarContainerAdminComponent;
  let fixture: ComponentFixture<SidebarContainerAdminComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SidebarContainerAdminComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(SidebarContainerAdminComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
