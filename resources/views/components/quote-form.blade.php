<div id="quote-modal" class="quote-modal-overlay" style="display:none;">
    <div class="quote-modal-content theme-match">
        <div class="quote-modal-header-bar"></div>
        <button class="quote-modal-close" onclick="document.getElementById('quote-modal').style.display='none';">&times;</button>
        <h2 class="quote-modal-title">Request A Quote</h2>
        <form method="POST" action="#" class="quote-form">
            @csrf
            <div class="quote-form-row">
                <div class="form-group">
                    <label for="quote_name">Name*</label>
                    <input type="text" id="quote_name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="quote_email">Email*</label>
                    <input type="email" id="quote_email" name="email" required>
                </div>
            </div>
            <div class="quote-form-row">
                <div class="form-group">
                    <label for="quote_phone">Phone</label>
                    <input type="tel" id="quote_phone" name="phone">
                </div>
                <div class="form-group">
                    <label for="facility_type">Type of Facility</label>
                    <select id="facility_type" name="facility_type" required>
                        <option value="">Select One</option>
                        <option>Corporate Security</option>
                        <option>Bank Security</option>
                        <option>Warehouse Security</option>
                        <option>HOA Security</option>
                        <option>Hospitality Security</option>
                        <option>Medical Building Security</option>
                        <option>Construction site Security</option>
                        <option>Retail Security</option>
                        <option>Parking Lot Security</option>
                        <option>Campus Security</option>
                        <option>Event Security</option>
                        <option>Residential Security</option>
                    </select>
                </div>
            </div>
            <div class="quote-form-row">
                <div class="form-group">
                    <label for="service_type">Select Service</label>
                    <select id="service_type" name="service_type" required>
                        <option value="">Select One</option>
                        <option>Armed Guard</option>
                        <option>Unarmed Guard</option>
                        <option>Mobile patrol</option>
                        <option>Fire watch</option>
                        <option>Security Parking control</option>
                        <option>Security Crowd Control</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="service_needed_by">Service Needed By</label>
                    <select id="service_needed_by" name="service_needed_by" required>
                        <option value="">Select One</option>
                        <option>As soon as possible</option>
                        <option>Within One week</option>
                        <option>Within Two Weeks</option>
                        <option>Within Four Weeks</option>
                        <option>Within Six Weeks</option>
                        <option>Flexible</option>
                    </select>
                </div>
            </div>
            <div class="quote-form-row">
                <div class="form-group">
                    <label for="area">Select Area</label>
                    <select id="area" name="area" required>
                        <option value="">Select One</option>
                        <option>Ventura</option>
                        <option>Los Angeles</option>
                        <option>Orange Country</option>
                        <option>Riverside</option>
                        <option>San Bernardino</option>
                        <option>San Diego</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="num_guards">Number of Guards</label>
                    <select id="num_guards" name="num_guards" required>
                        <option value="">Select One</option>
                        <option>Response as needed</option>
                        <option>1</option>
                        <option>2-5</option>
                        <option>6-10</option>
                        <option>11 or More</option>
                    </select>
                </div>
            </div>
            <div class="quote-form-row">
                <div class="form-group" style="width:100%">
                    <label for="referral">How Did you hear about us</label>
                    <select id="referral" name="referral" required>
                        <option value="">Select One</option>
                        <option>Google</option>
                        <option>Yelp</option>
                        <option>Facebook</option>
                        <option>Client Referral</option>
                        <option>Employee Referral</option>
                        <option>Phone Book</option>
                        <option>Other</option>
                    </select>
                </div>
            </div>
            <div class="quote-form-footer">
                <button type="submit" class="quote-btn">Request Quote</button>
            </div>
        </form>
    </div>
</div>
<style>
.quote-modal-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.45);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}
.quote-modal-content.theme-match {
    background: #fff;
    border-radius: 18px;
    max-width: 600px;
    width: 96vw;
    box-shadow: 0 8px 40px rgba(185,28,28,0.18);
    position: relative;
    font-family: 'Poppins', sans-serif;
    padding: 0 0 32px 0;
    border: 1px solid #f3f4f6;
    animation: quoteModalFadeIn 0.25s;
    overflow-y: auto;
}
.quote-modal-header-bar {
    width: 100%;
    height: 12px;
    background: #b91c1c;
    border-radius: 18px 18px 0 0;
}
@keyframes quoteModalFadeIn {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}
.quote-modal-title {
    font-size: 1.6rem;
    color: #b91c1c;
    font-weight: 800;
    margin: 32px 0 18px 0;
    text-align: center;
    letter-spacing: 1px;
}
.quote-modal-close {
    position: absolute;
    top: 10px;
    right: 18px;
    background: none;
    border: none;
    font-size: 2rem;
    color: #b91c1c;
    cursor: pointer;
    z-index: 2;
}
.quote-form {
    display: flex;
    flex-direction: column;
    gap: 0;
    padding: 0 32px;
}
.quote-form-row {
    display: flex;
    gap: 24px;
    margin-bottom: 18px;
}
.form-group {
    flex: 1 1 0;
    display: flex;
    flex-direction: column;
    margin-bottom: 0;
}
.quote-form label {
    font-weight: 600;
    color: #991b1b;
    margin-bottom: 6px;
    display: block;
    font-size: 1.08rem;
}
.quote-form input,
.quote-form select {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    font-size: 1rem;
    color: #23272b;
    background: #fafbfc;
    transition: border 0.2s, box-shadow 0.2s;
    margin-top: 2px;
    box-shadow: 0 1px 4px rgba(185,28,28,0.03);
}
.quote-form input:focus,
.quote-form select:focus {
    border-color: #b91c1c;
    outline: none;
    box-shadow: 0 0 0 2px #fee2e2;
}
.quote-btn {
    background: #b91c1c;
    color: #fff;
    font-weight: 700;
    font-size: 1.08rem;
    padding: 16px 0;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    margin-top: 24px;
    width: 100%;
    transition: background 0.2s, box-shadow 0.2s;
    box-shadow: 0 2px 8px rgba(185,28,28,0.07);
    letter-spacing: 1px;
}
.quote-btn:hover {
    background: #991b1b;
    box-shadow: 0 4px 16px rgba(185,28,28,0.13);
}
@media (max-width: 700px) {
    .quote-modal-content.theme-match {
        max-width: 100vw;
        width: 100vw;
        height: 80vh;
        margin: 0px 10px;
        border-radius: 0;
        padding: 0 0 12px 0;
        box-shadow: 0 0 0 #000;
    }
    .quote-modal-header-bar {
        position: sticky;
        top: 0;
        z-index: 10;
        height: 16px;
        border-radius: 0;
        margin-top: 0;
    }
    .quote-form {
        padding: 0 4vw;
    }
    .quote-modal-title {
        font-size: 1.2rem;
        margin: 24px 0 12px 0;
        text-align: center;
    }
    .quote-form-row {
        flex-direction: column;
        gap: 0;
        margin-bottom: 14px;
    }
    .form-group {
        margin-bottom: 8px;
    }
    .quote-btn {
        font-size: 1.1rem;
        padding: 14px 0;
        margin-top: 18px;
        border-radius: 10px;
        box-shadow: 0 2px 12px rgba(185,28,28,0.10);
    }
    .quote-modal-close {
        top: 8px;
        right: 12px;
        font-size: 1.5rem;
    }
}
</style>
<script>
function openQuoteModal() {
    document.getElementById('quote-modal').style.display = 'flex';
}
</script> 