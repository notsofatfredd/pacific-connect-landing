const email = 'Info@pacificconnect.co.za';
const intakeHref = 'mailto:Info@pacificconnect.co.za?subject=Request%20for%20a%20confidential%20assessment&body=Hello%20Pacific%20Connect%2C%0A%0AI%20would%20like%20to%20enquire%20about%3A%0A%0ABrief%20description%20of%20my%20matter%3A%0A%0AThank%20you.';

const services = [
  ['01', 'Debt review removals', 'A clearer view of the route available around your debt review status.'],
  ['02', 'Debt mediation', 'A considered look at more manageable repayment arrangements.'],
  ['03', 'Judgement removals', 'Understand the matter recorded against your name and the route to assess it.'],
  ['04', 'Prescribed debt assessments', 'Review whether older debt may still apply in your circumstances.'],
  ['05', 'Credit report investigations', 'Find the facts behind what appears on your credit report.'],
  ['06', 'Reckless lending assessments', 'Examine the circumstances around a lending decision.'],
];

export default function Home() {
  return <main>
    <header className="site-header">
      <a className="brand" href="#top" aria-label="Pacific Connect home"><img src="/logo-wordmark-transparent.png" alt="Pacific Connect" /></a>
      <div className="header-status"><span className="status-dot" /> Private intake <span className="header-divider" /> <a href={intakeHref}>Email us</a></div>
    </header>

    <section className="hero" id="top">
      <div className="hero-orbit" aria-hidden="true"><span /><span /><span /></div>
      <div className="hero-copy">
        <p className="eyebrow">PACIFIC CONNECT <span>/</span> CREDIT &amp; DEBT MATTERS</p>
        <h1>Make room<br />for a <i>clearer</i><br />next step.</h1>
        <p className="hero-intro">A considered assessment of the matter in front of you—so the route ahead is easier to understand.</p>
        <a className="hero-action" href={intakeHref}><span>Begin with an email</span><b aria-hidden="true">↗</b></a>
        <p className="hero-footnote">Every matter is assessed individually.</p>
      </div>
      <div className="hero-art" aria-hidden="true">
        <div className="art-label">A PRIVATE ROUTE<br /><strong>01—06</strong></div>
        <div className="art-disc" />
        <img src="/logo-mark-transparent.png" alt="" />
        <div className="art-caption"><span>THE FIRST MOVE</span><strong>Start with<br />what you know.</strong></div>
        <div className="art-line" />
      </div>
      <div className="hero-scroll"><span>Scroll to understand</span><i /></div>
    </section>

    <section className="signal-strip" aria-label="Pacific Connect approach">
      <span>INDIVIDUAL ASSESSMENT</span><b>✳</b><span>DOCUMENT-LED REVIEW</span><b>✳</b><span>CLEAR NEXT STEPS</span><b>✳</b><span>EMAIL-FIRST INTAKE</span>
    </section>

    <section className="intro-section">
      <div className="section-index">01 <span>/</span> APPROACH</div>
      <div className="intro-statement"><p className="eyebrow">NOT MORE NOISE</p><h2>Clarity is<br />a form of <i>relief.</i></h2></div>
      <div className="intro-note"><p>Debt and credit matters rarely arrive as a neat list. Pacific Connect begins with the details that matter, then helps identify which route may fit your circumstances.</p><a href="#services">Explore the routes <span>↓</span></a></div>
    </section>

    <section className="services-section" id="services">
      <div className="services-heading"><div className="section-index">02 <span>/</span> THE INDEX</div><h2>Where should<br />we <i>look?</i></h2><p>Six areas of assessment. One individual starting point.</p></div>
      <div className="service-list">{services.map(([number, title, copy]) => <article className="service-row" key={number}><span className="service-number">{number}</span><h3>{title}</h3><p>{copy}</p><span className="row-mark" aria-hidden="true">↗</span></article>)}</div>
    </section>

    <section className="mediation-section">
      <div className="mediation-figure"><span>UP TO</span><strong>50%</strong><small>conditional<br />assessment</small></div>
      <div className="mediation-copy"><p className="eyebrow">03 <span>/</span> DEBT MEDIATION</p><h2>Less pressure<br />can begin with<br /><i>one conversation.</i></h2><p>Monthly debt repayments may be reduced by up to 50%, depending on your financial situation and the agreement reached with creditors.</p><p className="disclaimer">This is not guaranteed. Every matter is assessed individually, and outcomes depend on circumstances, documents, creditor requirements and applicable legal processes.</p></div>
    </section>

    <section className="process-section">
      <div className="section-index">04 <span>/</span> HOW IT STARTS</div>
      <div className="process-heading"><h2>A short email<br />is a <i>good start.</i></h2><p>You do not need to have the whole story perfectly arranged. Begin with the broad outline and Pacific Connect can explain the next step.</p></div>
      <div className="process-steps"><div><span>01</span><h3>Tell us what is happening.</h3><p>Share the broad outline of your matter by email.</p></div><div><span>02</span><h3>Share what is relevant.</h3><p>Documents can be provided when they are requested.</p></div><div><span>03</span><h3>See the route clearly.</h3><p>Your situation is assessed individually and the available path is explained.</p></div></div>
    </section>

    <section className="closing-section" id="contact"><div className="closing-top"><p className="eyebrow">05 <span>/</span> START HERE</p><img src="/logo-wordmark-transparent.png" alt="Pacific Connect" /></div><div className="closing-main"><h2>Begin with<br /><i>an email.</i></h2><div><p>Tell us where you are, and we’ll help make the next step clearer.</p><a className="closing-action" href={intakeHref}>Email {email} <span>↗</span></a></div></div><div className="closing-bottom"><span>Pacific Connect / Private intake</span><a href="#top">Back to top ↑</a></div></section>
  </main>;
}
