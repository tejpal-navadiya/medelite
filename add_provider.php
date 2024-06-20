<!-- <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> Client</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?pid=home">Home</a></li>
                    <li class="breadcrumb-item active">Client</li>
                </ol>
            </div>
        </div>
    </div>
</div> -->
<?php
    $provider_titles_list=array("AACRN  Advanced HIV/AIDS Certified Registered Nurse","AAP - American Academy of Pediatrics","ABAI - American Board of Allergy and Immunology","ABFP - American Board of Family Practitioner","ABO - American Board of Otolaryngology","ABPN - American Board of Psychiatry and Neurology","ACRN - HIV/AIDS Certified Registered Nurse","AFN-BC - Advanced Forensic Nurses – Board Certified","AGAC-NP - Adult-Gerontology Acute Care Nurse Practitioner","AGN-BC - Advanced Genetic Nurses – Board Certified","AGPC-NP - Adult-Gerontology Primary Care Nurse Practitioner","AHN-BC - Advanced Holistic Nurses – Board Certified","AK Acupuncturist (Pennsylvania)","ALNC - Advanced Legal Nurse Consultant","ANP - Adult Nurse Practitioner","AOBFP - American Osteopathic Board of Family Physicians","AOBSPOMM - American Osteopathic Board of Special Proficiency in Osteopathic Manipulative Medicine AP Acupuncture Physician","AOCNP - Advanced Oncology Certified Nurse Practitioner","AOCNS - Advanced Oncology Certified Clinical Nurse Specialist","APHN-BC - Advanced Practice Holistic Nurse (Board Certified)","APRN - Advanced Practice Registered Nurse","ASG - Affiliated Study Group","BHMS - Bachelor of Homeopathic Medicine and Surgery","BMTCN - Blood & Marrow Transplant Certified Nurses","BSN - Bachelor of Science, Nursing","BVScAH - Bachelor of Veterinary Science and Animal Husbandry","CA - Certified Acupuncturist","CAAPM - Clinical Associate of the American Academy of Pain Management","CAC - Certified Animal Chiropractor","Camp Nursing","CANS - Certified Aesthetic Nurse Specialist","CAPA - Certified Ambulatory Perianesthesia Nurse","CBCN - Certified Breast Cancer Care Nurse","CBHC - Correctional Behavioral Health Certification","CCCN - Certified Continence Care Nurse","CCCTM - Certified Care Coordination and Transition Manager","CCH - Certified in Classical Homeopathy","CCRA - Certified Clinical Research Associate","CCRC - Certified Clinical Research Coordinator","CCRN - Critical Care Registered Nurse","CCRP - Certified Clinical Research Professional","CCSP Certified Chiropractic Sports Physician","CDN - Certified Dialysis Nurse","CEN - Certified Emergency Nurse","CENP - Certified in Executive Nursing Practice","CFCN - Certified Foot Care Nurse","CFRN - Certified Flight Registered Nurse","CGRN - Certified Gastroenterology Registered Nurse","CHFN - Certified Heart Failure Nurse","CHPCA - Certified Hospice and Palliative Care Administrator","CHPLN - Certified Hospice and Palliative Licensed Nurse","CHPNA - Certified Hospice and Palliative Nursing Assistant","CHRN - Certified Hyperbaric Registered Nurse","CNA - Certified Nursing Assistant","CNE - Certified Nurse Educator","CNL - Clinical Nurse Leader","CNM - Certified Nurse-Midwife","CNML - Certified Nurse Manager and Leader","CNO - Chief Nursing Officer","CNRN - Certified Neuroscience Registered Nurse","CNS - Clinical Nurse Specialist","COCN - Certified Ostomy Care Nurse","CPHON - Certified Pediatric Hematology Oncology Nurse","CPON - Certified Pediatric Oncology Nurse","CPSN - Certified Plastic Surgical Nurse","CRN - Certified Radiologic Nurse","CRNA - Certified Registered Nurse Anesthetist","CRNP Certified Registered Nurse Practitioner","CRRN -Certified Rehabilitation Registered Nurse","CRRN Certified Rehabilitation Registered Nurse","CSP - Community Specialist Practitioner","CSPOMM - Certified Specialty of Proficiency in Osteopathic Manipulation Medicine","CUNP - Certified Urologic Nurse Practitioner","CURN - Certified Urologic Registered Nurse ","CVA Certified Veterinary Acupuncturist","CWCN - Certified Wound Care Nurse","D.N.Sc., DNS - Doctor of Nursing Science","DAAPM - Diplomate of American Academy of Pain Management","DABFP - Diplomate of the American Board of Family Practice","DABIM - Diplomate of the American Board of Internal Medicine","DAc - Diplomate in Acupuncture","DACBN - Diplomate of American Chiropractic Board of Nutrition","DACVD - Diplomate of the American College of Veterinary Dermatology","DC - Doctor of Chiropractic","DCNP - Dermatology Certified Nurse Practitioner","DDS - Doctor of Dentistry","DHANP - Diplomate of the Homeopathic Academy of Naturopathic Physicians","DHt - Diplomate in Homeotherapeutics","DMD - Doctor of Medical Dentistry","DNAP - Doctor of Nurse Anesthesia Practice","DNBHE - Diplomate of the National Board of Homeopathic Examiners","DNC - Certified Dermatology Nurse","DNP - Doctor of Nursing Practice","DO -Doctor of Osteopathy","DOM - Doctor of Oriental Medicine","DPM - Doctor of Podiatric Medicine","DVM Doctor of Veterinary Medicine","EHN - Environmental Health Nurse","FAAEM - Fellow of the American Academy of Environmental Medicine","FAAFP - Fellow of the American Academy of Family Practitioners","FAAP - Fellow of the Association of American Pediatrics","FACFO - Fellow of the American College of Foot Orthopedics","FACOG - Fellow of the American College of Obstetrics and Gynecology","FAGD - Fellow of the Academy of General Dentistry","FCN - Faith Community Nursing","FIACA - Fellow of the International Academy of Clinical Acupuncture","FIAOMT - Fellow of the International Academy of Oral Medicine and Toxicology","FICCMO - Fellow of the International College of Cranio Mandibular Orthopedics","FNP - Family Nurse Practitioner","Forensic Nurse","GNP - Gerontological Nurse Practitioner","HASG - Homeopathic Affiliated Study Group","HHN - Home Health Nurse","HLL - Homoeopathic Laymen's League","HMD - Homeopathic Medical Doctor (Nevada)","HSG - Homoeopathic Study Group","HWNC-BC - Board Certified Health and Wellness Nurse Coach","Hyperbaric Nursing","ICU = Intensive Care Unit Nurse","Immunology and Allergy Nurse","Infection Control Nurse","Infectious Disease Nurse","Intravenous Therapy Nurse","LAc - Licensed Acupuncturist","LicAc - Licensed Acupuncturist","LN - Licensed Nutritionist","LNC - Licensed Nutritionist Counselor","LPN - Licensed Practical Nurse","MD - Doctor of Medicine","MD(H) - Homeopathic Medical Doctor (Arizona)","Medical and Uniformed Services Nurse","Medical Case Management","Medical-Surgical Nurse","MFCC - Marriage, Family and Child Counselor","MNNP - Master of Nursing, Nurse Practitioner","MPH - Master of Public Health","MSN - Master of Nursing","MSW - Master of Social Work","NA - Nursing Aid or Nursing Assistant","NC-BC - Nurse Coach Board Certified","NCCA -National Commission for the Certification of Acupuncturists","ND - Doctor of Naturopathy","NE-BC - Nurse Executive Board Certified","NEA-BC - Nurse Executive Advanced Board Certified","Neurosurgical Nurse","NI - Nursing Informatics","NIC - Neonatal Intensive Care Nurse","NNP - Neonatal Nurse Practitioner","NP Nurse Practitioner","Nurse Attorney","Occupational Health Nursing","OCN - Oncology Certified Nurse","OD - Doctor of Optometry","OMD - Doctor of Oriental Medicine","ONC - Certified Orthopaedic Nurse ","ONP - Oncology Nurse Practitioner","Other ","PA - Physician Assistant","PA-C -Physician Assistant Certified","PACU - Post-Anesthesia Care Unit Nurse","PCCN - Progressive Care Nurse","Perioperative Nursing","PhD - Doctor of Philosophy","PHNA - Advanced Public Health Nurses","PHNA-BC - Advanced Public Health Nurses – Board Certified","PMHCNS - Psychiatric & Mental Health Clinical Nurse Specialist","PMHNP - Psychiatric Mental Health Nurse Practitioner","PMHS - Pediatric Primary Care Mental Health Specialist","PNP - Pediatric Nurse Practitioner","PNP-AC = Acute Care Pediatric Nurse Practitioners","PPCNP-BC - Pediatric Primary Care Nurse Practitioner - Board Certified","Private Duty Nursing","PRN = Pro re nata (Per Diem Nurse)","PsyD Doctor of Psychology","PT Physical Therapist","Public Health Nursing","Pulmonary Nursing","Quality Improvement","Radiology Nursing","RDN - Registered Dental Nurse","Renal Nursing","RN - Registered Nurse","RN-C Registered Nurse Certified","RN/NP - Registered Nurse, Nurse Practitioner","RNCS - Registered Nurse Clinical Specialist","RPh - Registered Pharmacist","RS - Home Registered with the Society of Homeopaths","SANE-A - Sexual Assault Nurse Examiners – Adult/Adolescent","SANE-P - Sexual Assault Nurse Examiners – Pediatric","SCRN - Stroke Certified Registered Nurses","SG - Study Group","SNP-BC - School Nurse Practitioner (Board Certified)","Space Nursing","Sub-Acute Nursing","Substance Abuse Nursing","Surgical Nursing","TCRN - Trauma Certified Registered Nurses","Transplantation Nursing","Travel Nursing","TTN - Telephone Triage Nursing","VMD - Veterinary Medical Doctor","WHNP - Women’s Health Nurse Practitioner");
?>

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title"><?php if(isset($_REQUEST['id'])) {echo "Update";}else{echo "Add";} ?> Provider Details</h3>
                            </div>
                            <div class="col-sm-6 text-right">
                                <a href="index.php?pid=provider_list" class="btn btn-primary btn-sm">Back</a>
                            </div>        

                        </div>
                    </div>

                    <div class="card-body">
                        <form class="form-horizontal" id="provider_form"  method="post" >
                        <?php if(isset($_REQUEST['id'])){echo "<input type='hidden' id='id' value='".$_REQUEST['id']."'>";}?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label">Group Name</label>
                                    <div class="form-group">
                                        <input type="text" maxlength="100" name="teams" id="teams"  class="form-control" placeholder="Group Name" value="" >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div> 
                                <div class="col-sm-6">
                                    <label class="control-label">Tages</label>
                                    <div class="form-group">
                                        <input type="text" maxlength="100" name="tages" id="tages"  class="form-control" placeholder="Tages" value="" >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label">Provider Name <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" maxlength="100" name="provider_name" id="provider_name"  class="form-control" placeholder="Provider Name" value="" >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label">Provider Title <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <!-- <input type="text" maxlength="100" name="provider_title" id="provider_title"  class="form-control" placeholder="Provider Title" value="" > -->
                                        <select maxlength="100" name="provider_title" id="provider_title"  class="form-control select2" placeholder="Provider Title">
                                            <option value="">Select Title</option>
                                            <?php 
                                                for ($i=0; $i < count($provider_titles_list); $i++) 
                                                { 
                                                    echo "<option value='".($i+1)."'>".$provider_titles_list[$i]."</option>";
                                                }
                                            ?>
                                        </select>
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label">Speciality <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" maxlength="100" name="speciality" id="speciality"  class="form-control" placeholder="Speciality" value="" >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label">Provider Email<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="email" maxlength="100" name="provider_email" id="provider_email"  class="form-control" placeholder="Provider Email" value="" >
                                        <span class="help" id="msg2"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-center">
                                    <a href="index.php?pid=provider_list" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-secondary">Cancel</a>
                                    <button type="submit" id="provider_submit" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary">Submit Details</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                          
            </div>        
        </div>        

    </div>
</section>