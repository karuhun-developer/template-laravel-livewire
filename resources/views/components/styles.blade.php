<style>
    .sidebar [data-bs-toggle=collapse]:after {
        border: solid;
        border-width: 0 .075rem .075rem 0;
        content: " ";
        display: inline-block;
        padding: 2px;
        position: absolute;
        right: 1.5rem;
        top: 1.2rem;
        transform: rotate(45deg);
        transition: all .2s ease-out;
    }
    .sidebar [aria-expanded=true]:after, .sidebar [data-bs-toggle=collapse]:not(.collapsed):after {
        top: 1.4rem;
        transform: rotate(-135deg);
    }
    *, :after, :before {
        box-sizing: border-box;
    }
    .sidebar-dropdown .sidebar-item.active .sidebar-link {
        background: transparent;
        border-left: 0;
        color: #518be1;
        font-weight: 400;
    }
    .sidebar-dropdown .sidebar-link {
        background: transparent;
        border-left: 0;
        color: #adb5bd;
        font-size: 90%;
        font-weight: 400;
        padding: .625rem 1.5rem .625rem 3.25rem;
    }
    .sidebar-dropdown .sidebar-link::before {
        content: "→";
        display: inline-block;
        left: -14px;
        position: relative;
        transform: translateX(0);
        transition: all .1s ease;
    }
    .sidebar-dropdown .sidebar-link:hover::before {
        content: "→";
        display: inline-block;
        left: -8px;
        position: relative;
        transform: translateX(0);
        transition: all .1s ease;
    }
</style>
